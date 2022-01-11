<style>
    .footerbar {
        padding: 1rem 2rem;
        font-size: 20px;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        font-style: oblique;
        font-weight: bold;
    }

    .footerbar .taskbar-left li {
        list-style-type: none;
    }

    a.nav-link {
        text-decoration: none;
        color: black;
    }

    .footerbar .taskbar-right li {
        list-style-type: none;
    }

    .footerbar .taskbar-left, .taskbar-right {
        margin: 0;
        display: flex;
        flex-direction: row;
    }

    .footerbar ul {
        padding: 0;
    }
</style>

<footer class="footer mt-auto">
    <nav class="footerbar">
        <ul class="taskbar-left">
            <li class="nav-item">
                <p class="m-0 nav-link text-muted">© LBAW2153 {{ date('Y') }}</p>
            </li>
        </ul>

        <ul class="taskbar-right">
            <li class="nav-item">
                <a class="nav-link" href="/faq">FAQ</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/about">About</a>
            </li>
        </ul>

    </nav>
</footer>
