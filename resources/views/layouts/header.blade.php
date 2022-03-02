<header>
    <div class="top-framework">
        <p class="top-framework-title">Atte</p>
        @if(Auth::check())
        <nav>
            <ul class="flex">
                <li><a href="/" class="nav-link">ホーム</a></li>
                <li><a href="/attendance" class="nav-link">日付一覧</a></li>
                <li>
                    <form action="/logout" method="post">
                        @csrf
                        <button class="nav-link nav-btn">
                            ログアウト
                        </button>
                    </form>
                </li>
            </ul>
        </nav>
        @endif
    </div>
</header>
