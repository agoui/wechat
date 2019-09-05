<html>
    <head>
        <title>用户列表</title>
    </head>
    <body>
        <center>
            <table border="1">
                <tr>
                    <td>ID</td>
                    <td>用户openid</td>
                    <td>是否关注</td>
                    <td>城市</td>
                    <td>地区</td>
                    <td>头像</td>
                    <td>操作</td>
                </tr>
@foreach($info as $k=>$v)
    <tr>
        <td>{{$k}}</td>
        <td>{{$v['nickname']}}</td>
        <td>{{$v['subscribe']}}</td>
        <td>{{$v['city']}}</td>
        <td>{{$v['country']}}</td>
        <td><img src="{{asset($v['headimgurl'])}}" alt=""></td>
        <td>{{date('Y-m-d H:i:s',$v['subscribe_time'])}}</td>
        <td>
            <a href="{{url('wechat/get_detailed_info')}}?id={{$k}}">详情</a>
        </td>
    </tr>
    @endforeach
    </table>
    </center>
    </body>
    </html>