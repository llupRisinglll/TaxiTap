// Javascript Web Socket Connection Class - Javascript
var Connection = (function(){
    // This Class' Parameter and statement when instance is created.
    function Connection(username, url){
        this.username = username;
        this.open     = false;
        this.socket   = new WebSocket("ws://" + url);
        this.setupConnectionEvents();
    }

    // The following are the functions of Connection Class
    Connection.prototype = {
        updateUsername: function(){
            var data =
                JSON.stringify({
                    action: 'setname',
                    username: this.username
                });
            this.socket.send(data);
        },

        addSystemMessage: function(msg){ alert(msg); },

        setupConnectionEvents: function(){
            var self = this;
            self.socket.onopen      = function(evt){ self.connectionOpen(evt)       };
            self.socket.onmessage   = function(evt){ self.connectionMessage(evt)    };
            self.socket.onclose     = function(evt){ self.connectionClose(evt);     };
        },

        connectionOpen: function(evt){
            this.open = true;
            this.updateUsername();
        },

        connectionMessage: function(evt) {
            var data = JSON.parse(evt.data);
            if (!this.open){ return; }

            switch (data.action){

                case 'setname':
                    // This is what to do when successfully chosen the username
                    if (data.success){
                        this.shareLocation(originCoords);
                    }else{
                        alert("TaxiTap: Oops, An error occurs while setting up data on Socket.");
                        window.location.href = "";
                    }
                    break;

                // Do this when receive a location data from other user
                case 'shareLocation':
                    if (data.accountType == "driver"){
                        plotMarker(data.username, data.location);
                    }
                    break;
                case 'transactionReply':
                    if (data.status == "cancel"){
                        removeStatus();
                        alert("TaxiTap: For some reason, your transaction has been cancelled.");

                    } else if (data.status == "accept"){
                        selectedDriver = data.username;
                        pending = true;
                        showStatus();
                        alert("TaxiTap: Request accepts")

                    } else if (data.status = "decline"){
                        alert("For some reason the taxi has been declined.");

                    } else if (data.status = "finish"){
                        alert("Thank you for using as service. We hope that you enjoy a good transaction.");
                    }
                    break;
            }
        },

        // When the connection was closed
        connectionClose: function(evt){
            this.open = false;
            this.addSystemMessage("Failure Server Connectivity");
        },

        // Send Message to Admin (Tabulator) if the socket is open

        // you can share location when you location...
        shareLocation: function(location){
            if (this.open){
                var data = JSON.stringify (
                    {
                        action: 'shareLocation',
                        location: location,
                        accountType: "passenger"
                    }
                );
                this.socket.send(data);
            }
            else{ this.addSystemMessage("You are not connected to the server."); }
        },

        transaction: function (driver, destination, passengerNumber) {
            if (this.open){
                var data = JSON.stringify (
                    {
                        action: 'transaction',
                        target: driver,
                        destination: destination,
                        passengerNumber: passengerNumber
                    }
                );

                this.socket.send(data);
                selectedDriver = driver;
                pending = true;
                $("#status").css("visibility", "visible");
            }
            else{ this.addSystemMessage("You are not connected to the server."); }
        },

        cancelTransaction: function (driver) {
            if (this.open){
                var data = JSON.stringify (
                    {
                        action: 'transactionReply',
                        target: driver,
                        status: "cancel"
                    }
                );

                this.socket.send(data);
            }
            else{ this.addSystemMessage("You are not connected to the server."); }
        }
    };
    return Connection;
})();
