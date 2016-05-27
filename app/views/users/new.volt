<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("users", "Go Back") }}</li>
        </ul>
    </nav>
</div>

<div class="page-header">
    <h1>
        Create users
    </h1>
</div>

{{ content() }}

{{ form("users/create", "method":"post", "autocomplete" : "off", "class" : "form-horizontal") }}

<div class="form-group">
    <label for="fieldName" class="col-sm-2 control-label">{{ trans._('user.name.label') }}</label>
    <div class="col-sm-10">
        {{ form.render("name", {"size" : 30, "class" : "form-control" }) }}
    </div>
</div>

<div class="form-group">
    <label for="fieldEmail" class="col-sm-2 control-label">{{ trans._('user.email.label') }}l</label>
    <div class="col-sm-10">
        {{ form.render("email", {"size" : 30, "class" : "form-control"}) }}
    </div>
</div>

<div class="form-group">
    <label for="fieldPassword" class="col-sm-2 control-label">{{ trans._('user.password.label') }}</label>
    <div class="col-sm-10">
        {{ form.render("password", {"size" : 30, "class" : "form-control"}) }}
    </div>
</div>

<div class="form-group">
    <label for="fieldPassword" class="col-sm-2 control-label">{{ trans._('user.passwordconfirmation.label') }}</label>
    <div class="col-sm-10">
        {{ form.render("confirmPassword", {"size" : 30, "class" : "form-control"}) }}
    </div>
</div>

<div class="form-group">
    <label for="fieldPassword" class="col-sm-2 control-label">{{ trans._('user.roles.label') }}</label>
    <div class="col-sm-10">
        {{ form.render("UsersRole") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldPassword" class="col-sm-2 control-label">{{ trans._('user.enabled.label') }}</label>
    <div class="col-sm-10">
        {{ form.render("enabled") }}
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        {{ submit_button('Save', 'class': 'btn btn-default') }}
    </div>
</div>

</form>
