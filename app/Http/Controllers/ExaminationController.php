<?php

namespace App\Http\Controllers;
use App\ExaminationModel;

use App\StatsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExaminationController extends Controller
{
    //倒计时
    public function CountDown()
    {
        $pretime = time();
//        $predate=date('m-d',$pretime);
        $examtime1 = strtotime('2019-5-25');
        $examtime2 = strtotime('2019-10-11');
        $sub = ceil(($examtime1 - $pretime) / 86400);
        $sub2 = ceil(($examtime2 - $pretime) / 86400);
        $middate = strtotime('2019-06-01 00:00:00');
        if ($middate > $pretime) {
            return response()->json($sub);
        } else {
            return response()->json($sub2);
        }
    }



    //2009-2018试题数据
    public function QuestionsData(Request $request)
    {
        $data = $request->all();
        $field = $data['field'];
        $ques_content = ExaminationModel::where('field', '=', $field)->get(['id', 'question', 'questionImg', 'optiona', 'optionb', 'optionc', 'optiond', 'answer', 'answeranalysis']);

        $cnt = 0;
        if ($ques_content) {
            foreach ($ques_content as $val) {
                if ($cnt == 0) {
                    $id = $val->id;
                    $question = $val->question;
                    $optiona = $val->optiona;
                    $optionb = $val->optionb;
                    $optionc = $val->optionc;
                    $optiond = $val->optiond;
                    $answer = $val->answer;
                    $answeranalysis = $val->answeranalysis;

                    $all[] = array("id" => $id,
                        'question' => $question,
                        'optiona' => $optiona,
                        'optionb' => $optionb,
                        'optionc' => $optionc,
                        'optiond' => $optiond,
                        'answer' => $answer,
                        'answeranalysis' => $answeranalysis,);
                }
            }
            return response()->json(["message"=>$all]);
        }

    }


    //选择题判断
    public function ChoiceJudge(Request $request)
    {
        $questiondata = $request->all();
        $choice=$questiondata['option'];
        $questionid=$questiondata['id'];
        $field=$questiondata['field'];
  //      $user_id=$questiondata['user_id'];

        //获取提交的选择
        $optiondata=ExaminationModel::where('id','=',$questionid)->get(['answer']);

        $str = "";
        $cnt = 0;
        if($optiondata) {
            foreach ($optiondata as $values) {
                if ($cnt == 0) {
                    $str = $values->answer;
                }
            }
        }
        //错题题号统计

        if ($choice!=$str){
            $str1 = "";
            $cnt1 = 0;
            foreach (array($questionid) as $value) {
                if ($cnt1 == 0) {
                    $str1 = $value;
                } else {
                    $str1 = $str1 . ',' . $value;
                }
                $cnt1++;
            }

            $score=75-$cnt1;

            //存数据库;
            $stats=new StatsModel();
            $stats->statistical_error=$str1;
            $stats->error_count=$cnt1;
            $stats->score=$score;
            $stats->field=$field;
            $stats->save();
        }

        if($choice==$str){
            //选择正确，返回'10001'
            return response()->json('10004');
        }else{
            //选择错误，返回'10002'
            return response()->json('10005');
        }
    }

    //统计个人做题情况
    public function Personal(){

    }

    //统计受欢迎题目排行
    public function Charts()
    {
        //此段查询语句返回 stats表中 field 重复次数最多的5条记录各自总值
        $charts=StatsModel::select(DB::raw('count(*) as count'))
            ->groupBy('field')
            ->orderBy('count','desc')
            ->limit(5)->get();

       //此段查询语句返回 stats表中 field 重复次数最多的5条记录的试卷号
        $chartsmax=StatsModel::select('field')
            ->groupBy('field')
            ->orderBy(DB::raw('count(*)'),'desc')
            ->limit(5)
            ->get();

       return response()->json($chartsmax);
    }


    //返回各年份试题入口标题
    public function ExamTitle()
    {
        return response()->json([
            '20091' => '2009年上半年上午试题',
            '20092' => '2009年下半年上午试题',
            '20101' => '2010年上半年上午试题',
            '20102' => '2010年下半年上午试题',
            '20111' => '2011年上半年上午试题',
            '20112' => '2011年下半年上午试题',
            '20121' => '2012年上半年上午试题',
            '20122' => '2012年下半年上午试题',
            '20131' => '2013年上半年上午试题',
            '20132' => '2013年下半年上午试题',
            '20141' => '2014年上半年上午试题',
            '20142' => '2014年下半年上午试题',
            '20151' => '2015年上半年上午试题',
            '20152' => '2015年下半年上午试题',
            '20161' => '2016年上半年上午试题',
            '20162' => '2016年下半年上午试题',
            '20171' => '2017年上半年上午试题',
            '20172' => '2017年下半年上午试题',
            '20181' => '2018年上半年上午试题',
            '20182' => '2018年下半年上午试题',
        ]);
    }
}



