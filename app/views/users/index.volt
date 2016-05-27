<div class="page-header">
    <h1>
        {{ trans.t("search.title", {"model" : trans.t("users.whom")}) }}
    </h1>
    <p>
        {{ link_to("users/new", trans.t("new.title", {"model" : trans.t("users.whom")}) ) }}
    </p>
</div>

{{ content() }}

{{ form("users/search", "method":"post", "autocomplete" : "off", "class" : "form-horizontal") }}

<div class="form-group">
    <label for="fieldName" class="col-sm-2 control-label">{{ trans._('users.name.label') }}</label>
    <div class="col-sm-10">
        {{ text_field("name", "size" : 30, "class" : "form-control", "id" : "fieldName") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldEmail" class="col-sm-2 control-label">{{ trans._('users.email.label') }}</label>
    <div class="col-sm-10">
        {{ text_field("email", "size" : 30, "class" : "form-control", "id" : "fieldEmail") }}
    </div>
</div>
<div class="form-group">
    <label for="fieldEnabled" class="col-sm-2 control-label">{{ trans._('users.enabled.label') }}</label>
    <div class="col-sm-10">
        {{ select("enabled", ['1': trans.t("yes") , '0': trans.t("no")], "class" : "", "id" : "fieldEnabled") }}
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        {{ submit_button( trans._('btn.search'), 'class': 'btn btn-default') }}
    </div>
</div>

</form>
