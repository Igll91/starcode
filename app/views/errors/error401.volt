<div class="page-header">
    <h1>{{ trans.t("401.title") }}</h1>
</div>

<p>{{ trans.t("401.message") }}</p>

<ol class="breadcrumb">
    <li>
        <i class="fa fa-sign-in">
            {{ link_to("authentication/login", trans.t("login") ) }}
        </i>
    </li>

    <li>
        <i class="fa fa-file-text-o">
            {{ link_to("authentication/register", trans.t("register") ) }}
        </i>
    </li>
</ol>

