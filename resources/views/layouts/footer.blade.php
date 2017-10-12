<div class="footer footer-nav-icons">
    <div class="fp-footer">
        <div class="fp-content <?=(Request::is('home/*') || Request::is('home')) ? 'active' : '' ?>">
            <a href="{{ action('HomeController@index') }}">
                <i class="icon-dashboard badge-on-icon"></i>
                <h6>DASHBOARD</h6>
            </a>
        </div>
        <div class="fp-content <?=(Request::is('silos/*') || Request::is('silos')) ? 'active' : '' ?>">
            <a href="{{ action('SilosController@index') }}">
                <i class="icon-database badge-on-icon"></i>
                <h6>SILOS</h6>
            </a>
        </div>
        <div class="fp-content <?=(Request::is('blocks/*') || Request::is('blocks')) ? 'active' : '' ?>">
            <a href="{{ action('BlockController@index') }}">
                <i class="icon-cube badge-on-icon"></i>
                <h6>BLOCKS</h6>
            </a>
        </div>
        <div class="fp-content <?=(Request::is('stock/*') || Request::is('stock')) ? 'active' : '' ?>">
            <a href="{{ action('StockController@index') }}">
                <i class="icon-cubes badge-on-icon"></i>
                <h6>RESOURCES</h6>
            </a>
        </div>
        <div class="fp-content <?=(Request::is('rapporten/*')) ? 'active' : '' ?>">
            <a href="{{ action('RapportenController@index') }}">
                <i class="icon-rapports badge-on-icon"></i>
                <h6>REPORTS</h6>
            </a>
        </div>
    </div>
</div>
