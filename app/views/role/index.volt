{#<div class="page-header">#}
    {#<h1>#}
        {#Search Role#}
    {#</h1>#}
    {#<p>#}
        {#{{ link_to("Role/new", "Create Role") }}#}
    {#</p>#}
{#</div>#}

{#{{ content() }}#}

{#{{ form("Role/search", "method":"post", "autocomplete" : "off", "class" : "form-horizontal") }}#}

{#<div class="form-group">#}
    {#<label for="fieldLabel" class="col-sm-2 control-label">{{ trans._('role.name.label') }}</label>#}
    {#<div class="col-sm-10">#}
        {#{{ form.render("name") }}#}
    {#</div>#}
{#</div>#}

{#{{ form.render("csrf") }}#}

{#<div class="form-group">#}
    {#<div class="col-sm-offset-2 col-sm-10">#}
        {#{{ submit_button('Search', 'class': 'btn btn-default') }}#}
    {#</div>#}
{#</div>#}

{#</form>#}
