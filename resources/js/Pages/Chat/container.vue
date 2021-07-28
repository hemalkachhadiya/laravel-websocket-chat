<template>
  <app-layout>
    <template #menuitems>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <chat-room-selection
          v-if="currentRoom.id"
          :rooms="chatRooms"
          :currentRoom="currentRoom"
          :newroom="createroom"
          v-on:roomchanged="setRoom($event)"
          v-on:createnewroom="createnewroom($event)"
        />
      </h2>
    </template>
    <div class="grid grid-cols-1 md:grid-cols-5">
      <div
        v-if="createroom == true"
        class="
          col-span-2
          xl:col-span-1
          bg-white
          my-4
          px-1
          w-full
          overflow-x-hidden
          rounded-xl
        "
      >
        <div class="px-2 py-4 flex">
          <input
            class="
              border-gray-300
              focus:border-indigo-300
              focus:ring focus:ring-indigo-200 focus:ring-opacity-50
              rounded-l-md
              shadow-sm
              block
              w-full
            "
            v-model="newemail"
            type="email"
            placeholder="Search .. "
          />
          <button
            @click="finduser()"
            class="
              inline-flex
              items-center
              px-2
              py-2
              bg-gray-800
              border border-transparent
              rounded-r-md
              font-semibold
              text-xs text-white
              uppercase
              tracking-widest
              hover:bg-gray-700
              active:bg-gray-900
              focus:outline-none
              focus:border-gray-900
              focus:ring focus:ring-gray-300
              disabled:opacity-25
              transition
            "
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="h-6 w-6"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
              />
            </svg>
          </button>
        </div>
        <div class="border-l-2 border-red-500" v-if="emailerror != null">
          <label class="block font-medium text-sm text-gray-700" for="email"
            ><span class="ml-2 text-red-500">{{ emailerror }}</span></label
          >
        </div>

        <div
          class="border-l-2 border-indigo-500 bg-indigo-50"
          v-if="newuser != null"
        >
          <label for="newuser" class="mx-2">Sreach Result...</label>
          <div class="flex" @click="createnewchannel()">
            <img
              :src="newuser.profile_photo_url"
              class="rounded-full my-4 mx-2"
            />
            <div class="my-4 mx-2 flex flex-col justify-center w-full">
              <div class="font-bold text-md">{{ newuser.name }}</div>
              <div>last Message for it ...</div>
            </div>
          </div>
        </div>
        <div class="border-b border-gray-200 flex">
          <img
            :src="$page.props.user.profile_photo_url"
            class="rounded-full my-4 mx-2"
          />
          <div class="my-4 mx-2 flex flex-col justify-center w-full">
            <div class="font-bold text-md">{{ $page.props.user.name }}</div>
            <div>last Message for it ...</div>
          </div>
        </div>
        <div class="border-b border-gray-200 flex">
          <img
            :src="$page.props.user.profile_photo_url"
            class="rounded-full my-4 mx-2"
          />
          <div class="my-4 mx-2 flex flex-col justify-center w-full">
            <div class="font-bold text-md">{{ $page.props.user.name }}</div>
            <div>last Message for it ...</div>
          </div>
        </div>
        <div class="border-b border-gray-200 flex">
          <img
            :src="$page.props.user.profile_photo_url"
            class="rounded-full my-4 mx-2"
          />
          <div class="my-4 mx-2 flex flex-col justify-center w-full">
            <div class="font-bold text-md">{{ $page.props.user.name }}</div>
            <div>last Message for it ...</div>
          </div>
        </div>
      </div>
      <div
        class="
          col-span-2
          xl:col-span-1
          bg-white
          my-4
          px-1
          w-full
          overflow-x-hidden
          rounded-xl
          hidden
          md:block
        "
      >
        <div class="px-2 py-4 flex">
          <input
            class="
              border-gray-300
              focus:border-indigo-300
              focus:ring focus:ring-indigo-200 focus:ring-opacity-50
              rounded-l-md
              shadow-sm
              block
              w-full
            "
            v-model="newemail"
            type="email"
            placeholder="Search .. "
          />
          <button
            @click="finduser()"
            class="
              inline-flex
              items-center
              px-2
              py-2
              bg-gray-800
              border border-transparent
              rounded-r-md
              font-semibold
              text-xs text-white
              uppercase
              tracking-widest
              hover:bg-gray-700
              active:bg-gray-900
              focus:outline-none
              focus:border-gray-900
              focus:ring focus:ring-gray-300
              disabled:opacity-25
              transition
            "
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="h-6 w-6"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
              />
            </svg>
          </button>
        </div>
        <div class="border-l-2 border-red-500" v-if="emailerror != null">
          <label class="block font-medium text-sm text-gray-700" for="email"
            ><span class="ml-2 text-red-500">{{ emailerror }}</span></label
          >
        </div>

        <div
          class="border-l-2 border-indigo-500 bg-indigo-50"
          v-if="newuser != null"
        >
          <label for="newuser" class="mx-2">Sreach Result...</label>
          <div
            class="flex cursor-pointer"
            @click="createnewchannel(newuser.email)"
          >
            <img
              :src="newuser.profile_photo_url"
              class="rounded-full my-4 mx-2"
            />
            <div class="my-4 mx-2 flex flex-col justify-center w-full">
              <div class="font-bold text-md">{{ newuser.name }}</div>
              <div>last Message for it ...</div>
            </div>
          </div>
        </div>
        <div class="border-b border-gray-200 flex">
          <img
            :src="$page.props.user.profile_photo_url"
            class="rounded-full my-4 mx-2"
          />
          <div class="my-4 mx-2 flex flex-col justify-center w-full">
            <div class="font-bold text-md">{{ $page.props.user.name }}</div>
            <div>last Message for it ...</div>
          </div>
        </div>
        <div class="border-b border-gray-200 flex">
          <img
            :src="$page.props.user.profile_photo_url"
            class="rounded-full my-4 mx-2"
          />
          <div class="my-4 mx-2 flex flex-col justify-center w-full">
            <div class="font-bold text-md">{{ $page.props.user.name }}</div>
            <div>last Message for it ...</div>
          </div>
        </div>
        <div class="border-b border-gray-200 flex">
          <img
            :src="$page.props.user.profile_photo_url"
            class="rounded-full my-4 mx-2"
          />
          <div class="my-4 mx-2 flex flex-col justify-center w-full">
            <div class="font-bold text-md">{{ $page.props.user.name }}</div>
            <div>last Message for it ...</div>
          </div>
        </div>
      </div>
      <div class="col-span-3 xl:col-span-4" v-if="createroom == false">
        <div class="py-4">
          <div class="mx-auto sm:px-6 lg:px-8">
            <div
              class="
                bg-white
                overflow-hidden
                shadow-xl
                sm:rounded-lg
                flex flex-col
              "
            >
              <chat-header v-if="afterapi == true" :currentRoom="currentRoom" />
              <message-container
                id="messagecontainer"
                :messages="messages"
                style="flex-basis: 77vh"
              />
              <input-message
                v-if="afterapi == true"
                :room="currentRoom"
                v-on:messagesent="getMessages()"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import MessageContainer from "./messageContainer.vue";
import InputMessage from "./inputMessage.vue";
import ChatRoomSelection from "./chatRoomSelection.vue";
import ChatHeader from "./Chatheader.vue";

export default {
  components: {
    AppLayout,
    MessageContainer,
    InputMessage,
    ChatRoomSelection,
    ChatHeader,
  },
  data: function () {
    return {
      chatRooms: [],
      currentRoom: [],
      messages: [],
      createroom: false,
      newemail: null,
      emailerror: null,
      newuser: null,
      afterapi: false,
    };
  },
  watch: {
    currentRoom(val) {
      // if (oldVal.id) {
      //   this.disconnect(oldVal);
      // }
      this.connect();
    },
  },
  mounted() {
    var container = this.$el.querySelector("#messagecontainer");
    container.scrollTop = container.scrollHeight;
  },
  methods: {
    connect() {
      // this.disconnect(oldVal);
      if (this.currentRoom.id) {
        console.log("connecte");
        let vm = this;
        vm.getMessages();
        window.Echo.private("chat." + this.currentRoom.id).listen(
          ".message.new",
          (e) => {
            console.log(e);
            if (!("Notification" in window)) {
              alert("Web Notification is not supported");
              return;
            }
            console.log(e.chatMessage);
            let notibody = "";
            if (chatMessage.message == null) {
              notibody = chatMessage.document;
            } else {
              notibody = chatMessage.messgae;
            }
            Notification.requestPermission((permission) => {
              let notification = new Notification(e.chatMessage.user.name, {
                body: notibody, // content for the alert
                icon: "./images/amirali-mirhashemian-sc5sTPMrVfk-unsplash.jpg", // optional image url
              });

              // link to page on clicking the notification
              notification.onclick = () => {
                window.open(window.location.href);
              };
            });
            vm.getMessages();
            console.log("add2");
          }
        );
      }
    },
    disconnect(room) {
      window.Echo.leave("chat." + room.id);
    },
    getRooms() {
      axios
        .get("/chat/rooms")
        .then((result) => {
          this.chatRooms = result.data;
          // this.setRoom(result.data[0]);
        })
        .catch((err) => {
          console.log(err);
        });
    },
    setRoom(room) {
      this.currentRoom = room;
      this.afterapi = true;
    },
    createnewroom() {
      this.createroom = !this.createroom;
      this.emailerror = null;
      this.newuser = null;
      this.newemail = null;
      setTimeout(() => this.scrollEnd(), 1000);
    },
    scrollEnd() {
      var container = this.$el.querySelector("#messagecontainer");
      container.scrollTop = container.scrollHeight;
    },
    getMessages() {
      console.log("getMessage");
      axios
        .get("/chat/rooms/" + this.currentRoom.id + "/messages")
        .then((result) => {
          this.messages = result.data;
        })
        .catch((err) => {
          console.log(err);
        });
      this.scrollEnd();
    },
    finduser() {
      this.emailerror = null;
      this.newuser = null;
      if (this.newemail != null) {
        axios
          .post("/finduser", {
            email: this.newemail,
            _token: document.head.querySelector('meta[name="csrf-token"]')
              .content,
          })
          .then((result) => {
            this.newuser = result.data.data;
            this.crnewremail = this.newemail;
          })
          .catch((err) => {
            this.emailerror = err.response.data.message;
            this.newemail = null;
          });
      } else {
        this.emailerror = "Please Enter Email Id";
        this.newemail = null;
      }
    },
    createnewchannel(crnewremail) {
      this.setRoom(this.chatRooms[0]);
    //   axios
    //     .post("/createnewroom", {
    //       email: crnewremail,
    //     })
    //     .then((result) => {
    //       this.getRooms();
    //       let newroom = this.chatRooms.filter((e) => {
    //         if (e.id == result.data.room[0].room_id) {
    //           return e;
    //         }
    //       });
    //       if (newroom.length == 1) {
    //         this.setRoom(this.chatRooms[0]);
    //         // this.setRoom(newroom[0]);
    //       }
    //     })
    //     .catch((err) => {
    //       crnewremail = null;
    //     });
    },
  },
  created() {
    if (window.Notification) {
      console.log("Notifications are supported!");
    } else {
      alert("Notifications aren't supported on your browser!");
    }
    this.getRooms();
    setTimeout(() => this.scrollEnd(), 1000);
  },
};
</script>
