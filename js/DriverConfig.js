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

        addSystemMessage: function(msg){
            alert(msg);
        },

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
                    if (data.accountType == "passenger"){
                        plotMarker(data.username, data.location);
                    }
                    break;
                case 'transaction':
                    transactionModal(data.destination, data.passengerNumber, data.username);
                    break;
                case 'transactionReply':
                    if (data.status == "cancel"){
                        cancelTransaction();
                        alert("TaxiTap: For some reason, your transaction has been cancelled.");
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
                        accountType: "driver"
                    }
                );
                this.socket.send(data);
            }
            else{ this.addSystemMessage("You are not connected to the server."); }
        },

        transactionReply: function(username, status){
            if (this.open){
                var data = JSON.stringify (
                    {
                        action: 'transactionReply',
                        target: username,
                        status: status
                    }
                );
                this.socket.send(data);
            }
            else{ this.addSystemMessage("You are not connected to the server."); }
        }

    };
    return Connection;
})();
