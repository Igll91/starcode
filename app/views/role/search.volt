{#<div class="row">#}
    {#<nav>#}
        {#<ul class="pager">#}
            {#<li class="previous">{{ link_to("Role/index", "Go Back") }}</li>#}
            {#<li class="next">{{ link_to("Role/new", "Create ") }}</li>#}
        {#</ul>#}
    {#</nav>#}
{#</div>#}

{#<div class="page-header">#}
    {#<h1>Search result</h1>#}
{#</div>#}

{#{{ content() }}#}

{#<div class="row">#}
    {#<table class="table table-bordered">#}
        {#<thead>#}
            {#<tr>#}
                {#<th>Id</th>#}
                {#<th>{{ trans._('role.name.label') }}</th>#}

                {#<th></th>#}
                {#<th></th>#}
            {#</tr>#}
        {#</thead>#}
        {#<tbody>#}
            {#{% if page.items is defined %}#}
                {#{% for Role in page.items %}#}
                    {#<tr>#}
                        {#<td>{{ Role.getId() }}</td>#}
                        {#<td>{{ Role.getName() }}</td>#}

                        {#<td>{{ link_to("Role/edit/"~Role.getId(), "Edit") }}</td>#}
                        {#TODO: sweet alert are you sure?#}
                        {#<td>#}
                            {#{{ link_to("Role/delete/"~Role.getId(), "Delete",#}
                            {#'onclick' : 'deleteConfirmationSweetAlert(this);return false;',#}
                            {#'data-title' : trans._('role.delete.sweetalert.title'),#}
                            {#'data-text' : trans._('role.delete.sweetalert.text'),#}
                            {#'data-type' : 'warning') }}#}
                        {#</td>#}
                    {#</tr>#}
                {#{% endfor %}#}
            {#{% endif %}#}
        {#</tbody>#}
    {#</table>#}
{#</div>#}

{#<div class="row">#}
    {#<div class="col-sm-1">#}
        {#<p class="pagination" style="line-height: 1.42857;padding: 6px 12px;">#}
            {#{{ page.current~"/"~page.total_pages }}#}
        {#</p>#}
    {#</div>#}
    {#<div class="col-sm-11">#}
        {#<nav>#}
            {#<ul class="pagination">#}
                {#<li>{{ link_to("Role/search", "First") }}</li>#}
                {#<li>{{ link_to("Role/search?page="~page.before, "Previous") }}</li>#}
                {#<li>{{ link_to("Role/search?page="~page.next, "Next") }}</li>#}
                {#<li>{{ link_to("Role/search?page="~page.last, "Last") }}</li>#}
            {#</ul>#}
        {#</nav>#}
    {#</div>#}
{#</div>#}
