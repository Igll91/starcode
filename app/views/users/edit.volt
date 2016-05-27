<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("users", "Go Back") }}</li>
        </ul>
    </nav>
</div>

<div class="page-header">
    <h1>
        Edit users
    </h1>
</div>

{{ content() }}

{{ form("users/save", "method":"post", "autocomplete" : "off", "class" : "form-horizontal") }}

{{ form.render("id") }}

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
    <label for="fieldPassword" class="col-sm-2 control-label">{{ trans._('user.oldpassword.label') }}</label>
    <div class="col-sm-10">
        {{ form.render("oldPassword", {"size" : 30, "class" : "form-control"}) }}
    </div>
</div>

<div class="form-group">
    <label for="fieldPassword" class="col-sm-2 control-label">{{ trans._('user.newpassword.label') }}</label>
    <div class="col-sm-10">
        {{ form.render("newPassword", {"size" : 30, "class" : "form-control"}) }}
    </div>
</div>

<div class="form-group">
    <label for="fieldPassword" class="col-sm-2 control-label">{{ trans._('user.passwordconfirmation.label') }}</label>
    <div class="col-sm-10">
        {{ form.render("confirmPassword", {"size" : 30, "class" : "form-control"}) }}
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
