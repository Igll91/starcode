<div class="page-header">
    <h1>
        {# TODO: množina, jednina #}
        {{ trans._("search.title", {"model" : trans._(modelName ~ ".whom") }) }}
    </h1>
    <p>
        {{ link_to( modelName ~ "/new", trans._("create.link.message")) }}
    </p>
</div>

{{ content() }}

{{ form(modelName ~ "/search", "autocomplete" : "off", "class" : "form-horizontal") }}

{{ partial("crud/_form", {"form" : form}) }}

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        {{ submit_button(trans._("btn.search"), 'class': 'btn btn-default') }}
    </div>
</div>

</form>
