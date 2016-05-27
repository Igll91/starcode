{#<div class="row">#}
    {#<nav>#}
        {#<ul class="pager">#}
            {#<li class="previous">{{ link_to("Role", "Go Back") }}</li>#}
        {#</ul>#}
    {#</nav>#}
{#</div>#}

{#<div class="page-header">#}
    {#<h1>#}
        {#Create Role#}
    {#</h1>#}
{#</div>#}

{#{{ content() }}#}

{#{{ form("Role/create", "method":"post", "autocomplete" : "off", "class" : "form-horizontal") }}#}

{#<div class="form-group">#}
    {#<label for="name" class="col-sm-2 control-label">{{ trans._('role.name.label') }}</label>#}
    {#<div class="col-sm-10">#}
        {#{{ form.render("name", {"size" : 30, "class" : "form-control"}) }}#}
    {#</div>#}
{#</div>#}


{#<div class="form-group">#}
    {#<div class="col-sm-offset-2 col-sm-10">#}
        {#{{ submit_button('Save', 'class': 'btn btn-default') }}#}
    {#</div>#}
{#</div>#}

{#</form>#}
