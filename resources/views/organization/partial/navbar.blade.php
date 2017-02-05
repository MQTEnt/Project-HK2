<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">Let's Support</a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-bell" aria-hidden="true"></i>
                <?php
                    //Default User
                    $messages = App\Message::with('requirements')->where('opened', 0)->get();
                ?> 
                @if(count($messages) > 0)
                    <span id="count-messages" class="badge">{{count($messages)}}</span>
                @endif
                <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-messages">
                @foreach($messages as $message)
                <li>
                    <a href="#">
                        <div>
                            <strong>{{$message->requirements->towns->name.'/'.$message->requirements->towns->districts->name.'/'.$message->requirements->towns->districts->cities->name}}</strong>
                            <span data-message-id="{{$message->id}}" class="seen-message pull-right" data-toggle="tooltip" title="Đã xem">
                                <i class="fa fa-circle-o" aria-hidden="true"></i>
                            </span>
                            <span class="pull-right text-muted">
                                <em>{{$message->created_at}}</em>
                            </span>
                        </div>
                        <div>{{$message->content}}</div>
                    </a>
                </li>
                <li class="divider"></li>
                @endforeach
                <li>
                    <a class="text-center" href="#">
                        <strong>Xem lịch sử thông báo</strong>
                        <i class="fa fa-angle-right"></i>
                    </a>
                </li>
            </ul>
            <!-- /.dropdown-messages -->
        </li>
        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                </li>
                <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                </li>
                <li class="divider"></li>
                <li><a href="#"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li>
                    <a href="{{route('organization.projects.index')}}"><i class="fa fa-info-circle" aria-hidden="true"></i> Xem thông tin cứu trợ</a>
                </li>
                <li>
                    <a href="{{route('organization.requirements.index')}}"><i class="fa fa-paper-plane" aria-hidden="true"></i> Đăng kí cứu trợ</a>
                </li>
                <li>
                    <a href="{{route('organization.projects.list')}}"><i class="fa fa-newspaper-o" aria-hidden="true"></i> Lịch sử đăng kí</a>
                </li>
                <li>
                    <a href="{{route('organization.requirements.history')}}"><i class="fa fa-history" aria-hidden="true"></i> Xem lịch sử cứu trợ</a>
                </li>
                <li>
                    <a href="{{route('organization.search.index')}}"><i class="fa fa-search" aria-hidden="true"></i> Tra cứu</a>
                </li>
                <li>
                    <a href="{{route('organization.charts.index')}}"><i class="fa fa-area-chart fa-fw"></i> Xem thống kê</a>
                </li>
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>
<script>
    $(document).ready(function(){
        $('.seen-message').click(function(){
            message_id = $(this).attr('data-message-id');
            $.get('/message/seen/'+message_id, function(data, status){
            })
            li = $(this).parent().parent().parent();
            li.fadeOut('slow');
            li.next().fadeOut('slow');
            count_message = parseInt($('#count-messages').text());
            $('#count-messages').text(count_message-1);
            return false;
        });
    });
</script>