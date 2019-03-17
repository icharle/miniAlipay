<?php

namespace App\Http\Controllers;
use App\AfternoonModel;
use App\DzswModel;
use App\ExaminationModel;

use App\MediaModel;
use App\QrsModel;
use App\RjpcsModel;
use App\SjkModel;
use App\StatsModel;
use App\User;
use App\WlghModel;
use App\XtfxModel;
use App\XtghModel;
use App\XtjcModel;
use App\XtjgModel;
use App\XxaqModel;
use App\XxModel;
use App\XxxtModel;
use App\XxxtxmModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExaminationController extends Controller
{
    //倒计时 统计受欢迎题目排行
    public function CountDown()
    {
        $pretime = time();
        $examtime1 = strtotime('2019-5-25');
        $examtime2 = strtotime('2019-10-11');
        $sub = ceil(($examtime1 - $pretime) / 86400);
        $sub2 = ceil(($examtime2 - $pretime) / 86400);
        $middate = strtotime('2019-06-01 00:00:00');

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
        //返回热度前五
        if ($chartsmax){
            return response()->json($chartsmax);
        }
        //暂无记录时返回空
        if (!isset($chartsmax)){
            return response()->json();
        }
        //返回倒计时天数
        if ($middate > $pretime) {
            return response()->json($sub);
        } else {
            return response()->json($sub2);
        }
    }


    //根据用户type列出对应的试题数据
    public function QuestionsData(Request $request)
    {
        $data = $request->all();
        $field = $data['field'];
        $user_id=$data['user_id'];

        //查找用户type id
        $type_id=User::where('user_id','=',$user_id)->get(['type']);
        //转字符串
        $typecnt=0;
        if ($type_id){
            foreach ($type_id as $value){
                if ($typecnt==0){
                    $type=$value->type;
                }
            }
        }

        //根据type id返回对应试题信息
        /* type=
         * rjsj软件设计师(morning软件设计师上午题目 afternoon软件设计师下午题目）
         * dzsw电子商务设计师(上午题)
         * media多媒体应用设计师(上午题)
         * qrs嵌入式系统设计师(上午题)
         * rjpcs软件评测师(上午题)
         * sjk数据库系统工程师(上午题)
         * wlgh网络规划设计师(上午题)
         * wl网络工程师(上午题)
         * xtfx系统分析师(上午题)
         * xtgh系统规划与管理师(上午题)
         * xtjc系统集成项目管理工程师(上午题)
         * xtjg系统架构设计师(上午题)
         * xxaq信息安全工程师(上午题)
         * xx信息系统监理师(上午题)
         * xxxt信息系统管理工程师(上午题)
         * xxxtxm信息系统项目管理师(上午题)
         *
         */

        //查找试题信息
        if ($type='rjsj'){
            //查找上午试题信息
            $ques_content = ExaminationModel::where('field', '=', $field)->get(['id', 'question', 'questionImg', 'optiona', 'optionb', 'optionc', 'optiond', 'answer', 'answeranalysis']);
            //查找下午试题信息
            $aftques_content = AfternoonModel::where('field', '=', $field)->get();
        }

        elseif ($type='dzsw'){
            $ques_content = DzswModel::where('field', '=', $field)->get();
        }

        elseif ($type='media'){
            $ques_content = MediaModel::where('field', '=', $field)->get();
        }

        elseif ($type='qrs'){
            $ques_content = QrsModel::where('field', '=', $field)->get();
        }

        elseif ($type='rjpcs'){
            $ques_content = RjpcsModel::where('field', '=', $field)->get();
        }

        elseif ($type='sjk'){
            $ques_content = SjkModel::where('field', '=', $field)->get();
        }

        elseif ($type='wlgh'){
            $ques_content = WlghModel::where('field', '=', $field)->get();
        }

        elseif ($type='wl'){
            $ques_content = WlghModel::where('field', '=', $field)->get();
        }

        elseif ($type='xtfx'){
            $ques_content = XtfxModel::where('field', '=', $field)->get();
        }

        elseif ($type='xtgh'){
            $ques_content = XtghModel::where('field', '=', $field)->get();
        }

        elseif ($type='xtjc'){
            $ques_content = XtjcModel::where('field', '=', $field)->get();
        }

        elseif ($type='xtjg'){
            $ques_content = XtjgModel::where('field', '=', $field)->get();
        }

        elseif ($type='xxaq'){
            $ques_content = XxaqModel::where('field', '=', $field)->get();
        }

        elseif ($type='xx'){
            $ques_content = XxModel::where('field', '=', $field)->get();
        }

        elseif ($type='xxxt'){
            $ques_content = XxxtModel::where('field', '=', $field)->get();
        }

        elseif ($type='xxxtxm'){
            $ques_content = XxxtxmModel::where('field', '=', $field)->get();
        }

        if (isset($field)){
            $cnt = 0;
            if ($ques_content) {
                foreach ($ques_content as $val) {
                    if ($cnt == 0) {
                        $id = $val->id;
                        $question = $val->question;
                        $questionImg=$val->questionImg;
                        $optiona = $val->optiona;
                        $optionb = $val->optionb;
                        $optionc = $val->optionc;
                        $optiond = $val->optiond;
                        $answer = $val->answer;
                        $answeranalysis = $val->answeranalysis;

                        $all[] = array("id" => $id,
                            'question' => $question,
                            'questionImg'=>$questionImg,
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

            $afcnt = 0;
            if ($aftques_content) {
                foreach ($ques_content as $afvalue) {
                    if ($afcnt == 0) {
                        $id = $afvalue->id;
                        $question = $afvalue->question;
                        $questionImg=$afvalue->questionImg;
                        $optionA = $afvalue->optionA;
                        $optionAanswer = $afvalue->optionAanswer;
                        $optionAanswerImg = $afvalue->optionAanswerImg;
                        $optionB = $afvalue->optionB;
                        $optionBanswer = $afvalue->optionBanswer;
                        $optionBanswerImg = $afvalue->optionBanswerImg;
                        $optionC = $afvalue->optionC;
                        $optionCanswer = $afvalue->optionCanswer;
                        $optionCanswerImg = $afvalue->optionCanswerImg;
                        $optionD = $afvalue->optionD;
                        $optionDanswer = $afvalue->optionDanswer;
                        $optionDanswerImg = $afvalue->optionDanswerImg;
                        $optionE = $afvalue->optionE;
                        $optionEanswer = $afvalue->optionEanswer;
                        $optionEanswerImg = $afvalue->optionEanswerImg;

                        $all[] = array("id" => $id,
                            'question' => $question,
                            'questionImg'=>$questionImg,
                            'optionA' => $optionA,
                            'optionAanswer' => $optionAanswer,
                            'optionAanswerImg' => $optionAanswerImg,
                            'optionB' => $optionB,
                            'optionBanswer' => $optionBanswer,
                            'optionBanswerImg' => $optionBanswerImg,
                            'optionC' => $optionC,
                            'optionCanswer' => $optionCanswer,
                            'optionCanswerImg' => $optionCanswerImg,
                            'optionD' => $optionD,
                            'optionDanswer' => $optionDanswer,
                            'optionDanswerImg' => $optionDanswerImg,
                            'optionE' => $optionE,
                            'optionEanswer' => $optionEanswer,
                            'optionEanswerImg' => $optionEanswerImg,                      );
                    }
                }
                return response()->json(["message"=>$all]);
            }
        }else{
            return response()->json('20003');
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

}



