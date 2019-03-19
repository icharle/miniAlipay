<?php

namespace App\Http\Controllers;

use App\DzswModel;
use App\ExaminationModel;
use App\MediaModel;
use App\QrsModel;
use App\RjpcsModel;
use App\SjkModel;
use App\StatsModel;
use App\User;
use App\WlghModel;
use App\WlModel;
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
use Illuminate\Support\Facades\Auth;

class ExaminationController extends Controller
{
    function __construct()
    {
        $this->middleware('refresh.token', ['except' => ['login']]);  // 多个方法可以这样写 ['login','xxxx']   这样就会拦截出login方法
    }

    //倒计时 统计受欢迎题目排行
    public function CountDown()
    {
        $pretime = time();
        $examtime1 = strtotime('2019-5-25');                // 到时间手动改吧
        // todo 一般软考上半年都在5月25号  下半年都在11月10号   通过自动判断确定那一次考试
        $sub = ceil(($examtime1 - $pretime) / 86400);
        $userInfo = Auth::guard('api')->user();

        $type = $userInfo->type;  // 直接获取就可以了  搞这么复杂干啥

        if ($type == '0') {  // 即 未选择备考科目的时候直接返回倒计时
            return response()->json([
                'countdown'=>$sub,
                'list'=>[]
            ]);
        }

        //此段查询语句返回 stats表中 field 重复次数最多的5条记录各自总值
        $chartsmax=StatsModel::where('type','=',$type)->select(DB::raw('count(*) as count'))
            ->groupBy('field')
            ->orderBy('count','desc')
            ->limit(5)->get();

        //此段查询语句返回 stats表中 field 重复次数最多的5条记录的试卷号
        $charts=StatsModel::where('type','=',$type)->select('field')
            ->groupBy('field')
            ->orderBy(DB::raw('count(*)'),'desc')
            ->limit(5)
            ->get();

        //返回热度前五&倒计时天数
        $arr=[];
        $cnt=0;
        $flag=false;
        if (isset($charts)||isset($chartsmax)){

            foreach ($charts as $chaval){
                foreach ($chartsmax as $chamaxval){
                    if ($cnt==0) {
                        $arr[] = array("title" => $this->changeToTitle($chaval->field),
                            'total' => $chamaxval->count,
                         );
                    }
                    $flag=true;
                }
            }

        }
//        if (!$flag){
//            $arr[]=array(
//                'title'=>'',
//                'total'=>''
//            );
//        }

        return response()->json([
            'countdown'=>$sub,
            'list'=>$arr
        ]);



    }





    //根据用户type列出对应的试题数据
    public function QuestionsData(Request $request)
    {
        $data = $request->all();
        $field = $data['field'];
        $userInfo = Auth::guard('api')->user();

        //查找用户type id
        $type_id=User::where('user_id','=',$userInfo['user_id'])->get(['type']);

        $type = $userInfo->type;  // 直接获取就可以了  搞这么复杂干啥

        //根据type id返回对应试题信息
        /* type=
         * rjsj软件设计师(morning软件设计师上午题目）
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
        if ($type=='rjsj'){
            $ques_content = ExaminationModel::where('field', '=', $field)->get();
        }

        elseif ($type=='dzsw'){
            $ques_content = DzswModel::where('field', '=', $field)->get();
        }

        elseif ($type=='media'){
            $ques_content = MediaModel::where('field', '=', $field)->get();
        }

        elseif ($type=='qrs'){
            $ques_content = QrsModel::where('field', '=', $field)->get();
        }

        elseif ($type=='rjpcs'){
            $ques_content = RjpcsModel::where('field', '=', $field)->get();
        }

        elseif ($type=='sjk'){
            $ques_content = SjkModel::where('field', '=', $field)->get();
        }

        elseif ($type=='wlgh'){
            $ques_content = WlghModel::where('field', '=', $field)->get();
        }

        elseif ($type=='wl'){
            $ques_content = WlModel::where('field', '=', $field)->get();
        }

        elseif ($type=='xtfx'){
            $ques_content = XtfxModel::where('field', '=', $field)->get();
        }

        elseif ($type=='xtgh'){
            $ques_content = XtghModel::where('field', '=', $field)->get();
        }

        elseif ($type=='xtjc'){
            $ques_content = XtjcModel::where('field', '=', $field)->get();
        }

        elseif ($type=='xtjg'){
            $ques_content = XtjgModel::where('field', '=', $field)->get();
        }

        elseif ($type=='xxaq'){
            $ques_content = XxaqModel::where('field', '=', $field)->get();
        }

        elseif ($type=='xx'){
            $ques_content = XxModel::where('field', '=', $field)->get();
        }

        elseif ($type=='xxxt'){
            $ques_content = XxxtModel::where('field', '=', $field)->get();
        }

        elseif ($type=='xxxtxm'){
            $ques_content = XxxtxmModel::where('field', '=', $field)->get();
        } else {
            return response()->json();  // 未选择备考科目直接返回空 防止出现500不友好错误
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

        }else{
            return response()->json();
        }

    }

    //试卷提交，做题情况入库
    public function ScoreStats(Request $request){
        $data=$request->all();
        $errorques=$request['errorquestions']; //错题题号
        $score=$request['score'];//总分
        $field=$request['field'];//套题编号
        $userInfo = Auth::guard('api')->user();//用户id
        $errorcount=$data['errorcount'];//错题数目
        $time=$request['time']; //用时

        $stats=StatsModel::create([
            'user_id'=>$userInfo,
            'statistical_error' => $errorques,
            'field'=>$field,
            'error_count'=>$errorcount,
            'score'=>$score,
            'time'=>$time
        ]);

        if($stats){
            return response()->json('30001');
        }else{
            return response()->json('30002');
        }
    }


    //获取备考科目试题列表
    public function ExamTitle(){
        //get user_id
        $userInfo = Auth::guard('api')->user();//用户id

        $type = $userInfo->type;  // 直接获取就可以了  搞这么复杂干啥

        //查找试题field
        if ($type=='rjsj'){
            //查找上午试题信息
            $field = ExaminationModel::select(DB::raw('field'))
                ->groupBy('field')
                ->orderBy('field','desc')
                ->get();

        }

        else if ($type=='dzsw'){
            $field = DzswModel::select(DB::raw('field'))
                ->groupBy('field')
                ->orderBy('field','desc')
                ->get();
        }

        else if ($type=="media"){
            $field = MediaModel::select(DB::raw('field'))
                ->groupBy('field')
                ->orderBy('field','desc')
                ->get();
        }

        else if ($type=='qrs'){
            $field= QrsModel::select(DB::raw('field'))
                ->groupBy('field')
                ->orderBy('field','desc')
                ->get();
        }

        else if ($type=='rjpcs'){
            $field = RjpcsModel::select(DB::raw('field'))
                ->groupBy('field')
                ->orderBy('field','desc')
                ->get();
        }

        else if ($type=='sjk'){
            $field = SjkModel::select(DB::raw('field'))
                ->groupBy('field')
                ->orderBy('field','desc')
                ->get();
        }

        else if ($type=='wlgh'){
            $field = WlghModel::select(DB::raw('field'))
                ->groupBy('field')
                ->orderBy('field','desc')
                ->get();
        }

        else if ($type=="wl"){
            $field = WlModel::select(DB::raw('field'))
                ->groupBy('field')
                ->orderBy('field','desc')
                ->get();
        }

        else if ($type=='xtfx'){
            $field = XtfxModel::select(DB::raw('field'))
                ->groupBy('field')
                ->orderBy('field','desc')
                ->get();
        }

        else if ($type=='xtgh'){
            $field = XtghModel::select(DB::raw('field'))
                ->groupBy('field')
                ->orderBy('field','desc')
                ->get();
        }

        else if ($type=='xtjc'){
            $field = XtjcModel::select(DB::raw('field'))
                ->groupBy('field')
                ->orderBy('field','desc')
                ->get();
        }

        else if ($type=='xtjg'){
            $field = XtjgModel::select(DB::raw('field'))
                ->groupBy('field')
                ->orderBy('field','desc')
                ->get();
        }

        else if ($type=='xxaq'){
            $field = XxaqModel::select(DB::raw('field'))
                ->groupBy('field')
                ->orderBy('field','desc')
                ->get();
        }

        else if ($type=='xx'){
            $field = XxModel::select(DB::raw('field'))
                ->groupBy('field')
                ->orderBy('field','desc')
                ->get();
        }

        else if ($type=='xxxt'){
            $field = XxxtModel::select(DB::raw('field'))
                ->groupBy('field')
                ->orderBy('field','desc')
                ->get();
        }

        else if ($type=='xxxtxm'){
            $field = XxxtxmModel::select(DB::raw('field'))
                ->groupBy('field')
                ->orderBy('field','desc')
                ->get();
        }

        else {
            return response()->json();  // 未选择备考科目直接返回空 防止出现500不友好错误
        }


            $time_error= DB::select('SELECT time,field,error_count FROM stats WHERE user_id = ? AND created_at IN (
SELECT MAX(created_at) created_at FROM stats WHERE user_id = ? GROUP BY field)',[10000,10000]);

        $arr = [];  // 结果集
        foreach ($field as $t){  // 遍历所有场次
            $flag = false;
            foreach ($time_error as $a) { // 遍历所有已经答题的信息
                if ($t->field == $a->field){  // 如果有答题记录 使用答题记录的值
                    $arr[] =array(
                        'title' => $this->changeToTitle($a->field),
                        'field' => $a->field,
                        'time' => $a->time,
                        'error' => $a->error_count,
                    );
                    $flag = true;
                }
            }
            if (!$flag){  // 如果不存在答题记录 使用0
                $arr[] =array(
                    'title' => $this->changeToTitle($t->field),
                    'field' => $t->field,
                    'time' => '00:00',
                    'error' => '0',
                );
            }
        }

        return response()->json($arr);
    }

    // 通过field转成具体中文
    public function changeToTitle($field)
    {
        $year = substr($field,0,4);
        $msg = substr($field,4,1) == "1" ? "上半年" : "下半年";
        return $year ."年" .$msg;
    }

}



