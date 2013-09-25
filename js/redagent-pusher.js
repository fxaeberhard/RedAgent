YUI.add("redagent-pusher", function(Y) {

    var Pusher, PRESENCECHANNEL = "presence-redagent",
            APPKEY = '9d4eb6ada84f3af3c77f';

    Pusher = Y.Base.create("redagent-pusher", Y.Base, [], {
        initializer: function() {
            if (window.Pusher) {
                window.Pusher.log = Y.log;
                //var pusher = new Pusher(APPKEY);
                var pusher = new window.Pusher(APPKEY, {authEndpoint: 'php/endpoint.php'});

                this.channel = pusher.subscribe(PRESENCECHANNEL);
            }
            Y.RedAgent.pusher = this;
        }
    });
    Y.namespace("RedAgent").Pusher = Pusher;
});
