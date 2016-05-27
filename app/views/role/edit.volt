{#<div class="row">#}
    {#<nav>#}
        {#<ul class="pager">#}
            {#<li class="previous">{{ link_to("Role", "Go Back") }}</li>#}
        {#</ul>#}
    {#</nav>#}
{#</div>#}

{#<div class="page-header">#}
    {#<h1>#}
        {#Edit Role#}
    {#</h1>#}
{#</div>#}

{#{{ content() }}#}

{#{{ form("Role/save", "method":"post", "autocomplete" : "off", "class" : "form-horizontal") }}#}

{#<div class="form-group">#}
    {#<label for="fieldLabel" class="col-sm-2 control-label">{{ trans._('role.name.label') }}</label>#}
    {#<div class="col-sm-10">#}
        {#{{ form.render("name", {"size" : 30, "class" : "form-control"}) }}#}
    {#</div>#}
{#</div>#}

{#{{ form.render("id") }}#}

{#<div class="form-group">#}
    {#<div class="col-sm-offset-2 col-sm-10">#}
        {#{{ submit_button('Send', 'class': 'btn btn-default') }}#}
    {#</div>#}
{#</div>#}

{#</form>#}
