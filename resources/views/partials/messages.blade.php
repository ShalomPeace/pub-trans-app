<section class="row" ng-show="messages.get().length">
    <div class="col s12">
        <p ng-repeat="message in messages.get()" class="@{{ message.type }}-message center-align">@{{ message.message }}</p>
    </div>
</section>