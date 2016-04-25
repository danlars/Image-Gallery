<div class="container">
    <div class="row">
        <div class="col-lg-offset-4 col-lg-4 col-md-offset-4 col-md-4">
            {{ form('login/authenticate', 'method': 'post') }}
            <div class="form-group">
            <label for="email">Email</label>
                {{ form.render('email') }}
            </div>
            <div class="form-group">
            <label for="password">Password</label>
                {{ form.render('password') }}
            </div>
                {{ form.render('csrf', ['value': security.getToken()]) }}
                {{ submit_button("LOGIN", "class": "btn btn-primary pull-right") }}
            {{ end_form() }}
        </div>
    </div>
</div>