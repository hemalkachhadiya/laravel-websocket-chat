<template>
  <div class="relative h-10 m-1">
    <div class="flex">
      <!-- <input
        type="text"
        v-model="message"
        @keyup.enter="sendMessage()"
        placeholder="Say something..."
        class="p-1 mt-1 outline-none"
      /> -->

      <input
        v-model="message"
        @keyup.enter="sendMessage()"
        class="
          bg-gray-200
          appearance-none
          border-2 border-gray-200
          rounded
          w-full
          py-2
          px-4
          leading-tight
          focus:outline-none
          focus:bg-white
          focus:border-indigo-500
        "
        id="inline-full-name"
        type="text"
        placeholder="Say something..."
      />
      <div class="flex justify-center items-center cursor-pointer">
        <div class="absolute">
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
              d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"
            />
          </svg>
        </div>
        <input
          type="file"
          class="w-16 cursor-pointer opacity-0"
          ref="images"
          accept="image/*"
          v-on:change="sendMessage()"
        />
      </div>
      <div class="flex justify-center items-center cursor-pointer">
        <div class="absolute">
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
              d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"
            />
          </svg>
        </div>
        <input
          type="file"
          class="w-16 cursor-pointer opacity-0"
          ref="videos"
          accept="video/mp4,video/x-m4v,video/*"
          v-on:change="sendMessage()"
        />
      </div>
    </div>
  </div>
</template>
<script>
import Input from "../../Jetstream/Input.vue";
export default {
  components: { Input },
  props: ["room"],
  data: function () {
    return {
      message: "",
    };
  },
  methods: {
    sendMessage() {
      if (this.message === "") {
        if (this.$refs.images.files[0] === undefined) {
          if (this.$refs.videos.files[0] === undefined) {
            return;
          }
        }
      } else {
        this.message = this.message.trim();
      }
      let images = this.$refs.images.files[0];
      let videos = this.$refs.videos.files[0];
      let formData = new FormData();
      formData.append(
        "_token",
        document.head.querySelector('meta[name="csrf-token"]').content
      );
      formData.append("images", images);
      formData.append("videos", videos);
      formData.append("message", this.message);
      axios
        .post("/chat/rooms/" + this.room.id + "/message", formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then((result) => {
          if (result.status == 201) {
            this.message = "";
            let reset = this.$refs.images;
            reset.type = "text";
            reset.type = "file";
            let reset1 = this.$refs.videos;
            reset1.type = "text";
            reset1.type = "file";
            this.$emit("messagesent");
          }
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
  created(){
    console.log(this.room);
  }
};
</script>