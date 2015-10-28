<div class="row visible-xs" id="mobile-header">
    <div class="pull-left col-sm-6">
        <button id="hamburger-toggle" class="cmn-toggle-switch cmn-toggle-switch__htx visible-xs toggled-off">
            <span>toggle menu</span>
        </button>
    </div>
    <div id="logo" class="col-sm-6 pull-right mobile-logo">
        <a href="<?php echo get_home_url(); ?>"><span class="jumboGSA">GSA</span>BLOG</a>
    </div>
</div>
<nav id="slideout-menu">
    <form accept-charset="UTF-8" action="http://search.gsa.gov/search" id="mobile_search_form" method="get">
        <input name="affiliate" type="hidden" value="gsa.gov">
        <input name="utf8" type="hidden" value="✓">
        <div class="form-group">
            <label class="sr-only" for="query">Enter Search Term(s):</label>
            <input autocomplete="off" class="usagov-search-autocomplete ui-autocomplete-input"  id="mobile_query" name="query" type="text" role="textbox" aria-autocomplete="list" aria-haspopup="true">
            <button id="submit-search" type="submit"><span class="glyphicon glyphicon-search"></span></button>
        </div>
    </form>
    <h3><a href="#">Home</a></h3>
    <ul>
        <li><a class="toggle-submenu" href="#">What GSA Offers<span class="icon-arrow-down"></span></a>
            <ul>
                <li><a href="http://www.gsa.gov/portal/category/20987">Buildings &amp; Real Estate</a></li>
                <li><a href="http://www.gsa.gov/portal/category/21027">Products &amp; Services</a></li>
                <li><a href="http://www.gsa.gov/portal/category/21219">Policy &amp; Regulations</a></li>
            </ul>
        </li>
        <li><a class="toggle-submenu" href="#">Doing Business with GSA<span class="icon-arrow-down"></span></a>
            <ul>
                <li><a href="http://www.gsa.gov/portal/category/20998">Purchasing Programs</a></li>
                <li><a href="http://www.gsa.gov/portal/category/21122">Real Estate Services</a></li>
            </ul>
        </li>
        <li><a class="toggle-submenu" href="#">Learn More<span class="icon-arrow-down"></span></a>
            <ul>
                <li><a href="http://www.gsa.gov/portal/category/21023">How We Help</a></li>
                <li><a href="http://www.gsa.gov/portal/category/20982">About GSA</a></li>
                <li><a href="http://www.gsa.gov/portal/category/26627">Newsroom</a></li>
            </ul>
        </li>
        <li><a href="http://gsablogs.gsa.gov/gsablog/">Blog</a></li>
    </ul>
</nav>
<!-- /mobile-menu -->