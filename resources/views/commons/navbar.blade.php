<header class="mb-4">
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        {{-- トップページへのリンク --}}
        <a class="navbar-brand" href="/">MovieReview</a>

        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="nav-bar">
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav">
                 @if (Auth::check())
                 {{-- レビュー投稿画面へのリンク --}}
                 <li class="nav-item"><a href="{{ route('create') }}" class='nav-link'>レビューする</a></li>
                 <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name }}</a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            
                            {{-- 投稿一覧(自分) --}}
                            <li class="dropdown-item">{!! link_to_route('reviewshow', '投稿一覧（自分）') !!}</li>
                            <li class="dropdown-divider"></li>
                            {{-- 投稿一覧(他ユーザ含む) --}}
                            <li class="dropdown-item">{!! link_to_route('usersreview', '投稿一覧（他ユーザ含む）') !!}</li>
                            <li class="dropdown-divider"></li>
                            {{-- お気に入り一覧 --}}
                            <li class="dropdown-item"></li>
                            <li class="dropdown-divider"></li>
                            {{-- ログアウトへのリンク --}}
                            <li class="dropdown-item">{!! link_to_route('logout.get', 'ログアウト') !!}</li>
                        </ul>
                    </li>
                @else
                {{-- ログインページへのリンク --}}
                <li class="nav-item">{!! link_to_route('login', 'ログイン', [], ['class' => 'nav-link']) !!}</li>
                {{-- 新規ユーザ登録ページへのリンク --}}
                <li class="nav-item">{!! link_to_route('signup.get', '新規登録', [], ['class' => 'nav-link']) !!}</li>
                @endif
            </ul>
        </div>
    </nav>
</header>
