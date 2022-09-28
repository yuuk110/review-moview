<ul class="nav nav-tabs nav-justified mb-3">
　　<li class="nav-item"><a href="{{ route('reviewshow') }}" class="nav-link {{ Request::is('reviewshow') ? 'active' : '' }}">投稿一覧(自分)</a></li>
　　<li class="nav-item"><a href="{{ route('favorites', ['id' => Auth::id()]) }}" class="nav-link {{ Request::is('favorites') ? 'active' : '' }}">お気に入り一覧</a></li>
</ul>