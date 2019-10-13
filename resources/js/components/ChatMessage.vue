<template>

    <div class="mesgs">
         

        <div class="msg_history" ref="msg_history">
            <div :class="{incoming_msg: message.senderId != 'admin', outgoing_msg: message.senderId == 'admin' }" v-for="message in orderedMessages" >

                <div class="incoming_msg_img" v-if="message.senderId != 'admin'"> 
                    <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil">
                </div>
                <div class="received_msg" v-if="message.senderId != 'admin'">
                    <div class="received_withd_msg">
                      <p>{{ message.messageBody }}</p>
                      <span class="time_date"> <span>{{ message.timestamp | moment("from") }}</span> </span></div>
                </div>

                <div class="sent_msg" v-if="message.senderId == 'admin'" >
                    <p>{{ message.messageBody }}</p>
                    <span class="time_date"> <span>{{ message.timestamp | moment("from") }}</span>   </span> 
                </div>

            </div>


        </div>


        <div class="type_msg">
            <div class="input_msg_write">
              <input @keyup.enter="sendMessage" v-model="messageBody" type="text" class="write_msg"   placeholder="Type a message" />
              <button class="msg_send_btn" v-on:click="sendMessage" type="button"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
            </div>
        </div>

    </div>



    

</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },


        data() {
            return {
                messages: [],
                messageBody: "",
                senderId: "admin",
                recipientId: "kermakaze"
            }
        },
        created() {
            this.initApp()   

            Event.$on("onActiveUserChaged", (data) => {
                this.recipientId = data.id.toString();
                this.loadMessage();
            });

        },

        methods: {

            initApp () {
                const config = {
                    apiKey: "AIzaSyCW3AkoT3tIRJLBMF9jUCrikea5Cf1gbRU",
                    authDomain: "promo-pitch-1550250738193.firebaseapp.com",
                    databaseURL: "https://promo-pitch-1550250738193.firebaseio.com",
                    projectId: "promo-pitch-1550250738193",
                    storageBucket: "promo-pitch-1550250738193.appspot.com",
                    messagingSenderId: "701189542587"
                };


                firebase.initializeApp(config);
            },
            sendMessage : function () {
                const message = {
                    id: lil.uuid(),
                    messageBody: this.messageBody,
                    senderId: this.senderId,
                    recipientId: this.recipientId,
                    messageRead: false,
                    messageType: 'TEXT',
                    timestamp: Date.now(),

                };

                console.log(message);

                firebase.database().ref(`Chats/admin-${this.recipientId}/messages/${message.id}`)
                    .set(message);
                this.messageBody = "";

            },
            loadMessage: function () {
                var chats = firebase.database().ref('Chats/admin-'+this.recipientId+'/messages').orderByChild('timestamp');

                const self = this;
                
                chats.on('value', function(snapshot) {

                    console.log(snapshot.val())
                    self.messages = snapshot.val();
                    window.a = self.messages;
                    var msg = self.$refs.msg_history;
                    
                    msg.scrollTop = msg.scrollHeight;
                });

            }

        },
        computed: {
          orderedMessages: function () {
            return _.orderBy(this.messages, 'timestamp')
          }
        }


    }
</script>
