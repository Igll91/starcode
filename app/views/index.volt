<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Phalcon PHP Framework</title>

        <!-- Base CSS -->
        {{ stylesheet_link('css/main.min.css') }}
    </head>
    <body>

        {% if auth.getCurrentUser() %}

            <!-- HEADER MENU -->
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        {{ link_to("index", trans.t("nav.home"), "class" : "navbar-brand") }}
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">

                            {% if auth.getCurrentUser().getUserRole() == "SUPER_ADMIN" or auth.getCurrentUser().getUserRole() == "SILVER_USER" %}
                                {{ partial("layouts/_navigation_link", {"path" : "silver", "controller"  : "silver", "title" : trans.t("nav.silver")}) }}
                            {% endif %}

                            {# NOTE: 2x repetition for ROLE checking TODO: combine security + menu rendering #}
                            {% if auth.getCurrentUser().getUserRole() == 'SUPER_ADMIN' %}
                                <li class="dropdown {% if router.getControllerName() == 'role' or router.getControllerName() == 'users' %}active{% endif %}">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                       aria-haspopup="true" aria-expanded="false">CRUD <span
                                                class="caret"></span></a>

                                    <ul class="dropdown-menu">
                                        {{ partial("layouts/_navigation_link", {"path" : "users/index", "controller"  : "users", "title" : trans.t("nav.users")}) }}
                                        {{ partial("layouts/_navigation_link", {"path" : "role/index", "controller"  : "role", "title" : trans.t("nav.role")}) }}
                                    </ul>

                                </li>
                            {% endif %}

                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                   aria-haspopup="true" aria-expanded="false">
                                    {{ trans.t("loggedin", { "username" : auth.getCurrentUser().getName() }) }}
                                    <span class="caret"></span></a>
                                <ul class="dropdown-menu">

                                    {#{% if session.has(Auth.) %}#}

                                    <li>
                                        {{ link_to("authentication/logout", trans.t("logout") ) }}
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>

        {% else %}
            <!-- HEADER MENU -->
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        {{ link_to("index", trans.t("nav.home"), "class" : "navbar-brand") }}
                    </div>

                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                {{ link_to("authentication/register", trans.t("register") ) }}
                            </li>
                            <li>
                                {{ link_to("authentication/login", trans.t("login") ) }}
                            </li>
                        </ul>
                    </div>
                </div><!-- /.navbar-collapse -->
            </nav>
        {% endif %}

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    {{ content() }}
                </div>
            </div>
        </div>

        <!-- Base JS -->
        {{ javascriptInclude('js/main.min.js') }}
    </body>
</html>
