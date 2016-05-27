<div class="page-header">
    <h1>Congratulations!</h1>
</div>

<p>You're now flying with Phalcon. Great things are about to happen!</p>

<p>This page is located at <code>views/index/index.volt</code></p>

{% if auth.getCurrentUser() %}
    <hr>
    <blockquote>
        <p>Hvala na registiranju i korištenju aplikacije!</p>
        <p>
            Vivamus accumsan neque felis, nec interdum urna lacinia convallis. Morbi vitae odio placerat, volutpat massa
            vitae, posuere velit. Donec cursus non diam vitae sodales. Mauris quis scelerisque felis. Integer id nulla
            at nibh feugiat accumsan placerat eu urna. Nulla enim eros, pretium euismod aliquet in, rutrum vitae est.
            Integer dapibus euismod dictum. Phasellus ac odio nec eros blandit vulputate pellentesque vel quam. Morbi
            lacus lorem, eleifend ac scelerisque hendrerit, suscipit a sapien.
        </p>
    </blockquote>
{% endif %}