<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to(modelName, trans._("action.back")) }}</li>
        </ul>
    </nav>
</div>

<div class="page-header">
    <h1>

        {{ trans._("new.title", {"model" : trans._(modelName ~ ".whom") }) }}
    </h1>
</div>

{{ content() }}

{{ form(modelName ~ "/create", "method":"post", "autocomplete" : "off", "class" : "form-horizontal") }}

{{ partial("crud/_form", {"form" : form}) }}

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        {{ submit_button(trans._("btn.new"), 'class': 'btn btn-default') }}
    </div>
</div>

</form>
