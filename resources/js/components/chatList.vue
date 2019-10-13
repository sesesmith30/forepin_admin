<template>
    <div class="inbox_chat">
        <div class="chat_list" v-for="user in users" v-on:click="onChatListTapped(user)">
            <div class="chat_people" style="cursor: pointer;">
                <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                <div class="chat_ib">
                    <h5>{{ user.name }} <span class="chat_date">username: {{ user.username }}</span></h5>
                    <p>{{ user.email }}</p>
                </div>
          </div>
        </div>
    </div>

</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
            const self = this;
            axios.get("/api/promoter").then(function(response) {
                self.users = response.data;
                console.log(response);
            });


        },
        methods: {

            onChatListTapped(user) {
                Event.$emit("onActiveUserChaged",user);
            }

        },


        data() {
            return {
                users: []
            }
        }
    }
</script>
