<div class="row">
    <div class="col-md-6 col-md-offset-3">

        <div class="page-header">
            <h1>{{ trans._("register.title") }}</h1>
        </div>

        {{ content() }}

        {{ form("authentication/checkRegistration", "autocomplete" : "off", "class" : "form-horizontal") }}

        {{ partial("crud/_form", {"form" : form}) }}

        <div class="form-group">
            <div class="col-md-offset-2 col-sm-10">
                <img id="captcha" src="../securimage/securimage_show.php" alt="CAPTCHA Image"/>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-offset-2 col-sm-10">
                <input type="text" name="captcha_code" size="10" maxlength="6"/>

                <a href="#" role="button" class="btn btn-default"
                   onclick="document.getElementById('captcha').src = '../securimage/securimage_show.php?' + Math.random(); return false">
                    <i class="fa fa-refresh"></i>
                </a>
            </div>
        </div>

        <hr>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                {{ submit_button(trans._("btn.save"), 'class': 'btn btn-success') }}
            </div>
        </div>

        </form>
    </div>

</div>
</div>
