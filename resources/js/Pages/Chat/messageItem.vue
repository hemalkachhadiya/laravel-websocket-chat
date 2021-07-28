<template>
  <!-- <div>{{ $page.props.user.name }}</div> -->

  <div
    v-if="$page.props.user.id == message.user.id"
    class="
      bg-green-400
      float-right
      w-max
      my-2
      p-2
      rounded-xl rounded-tr-none
      clearfix
      text-white
    "
    style="max-width: 75%; max-width: 75%; max-width: 75%"
  >
    <div class="" v-if="message.document === null && message.message !== null">
      {{ message.message }}
    </div>
    <div v-if="message.doc_type == 'images'">
      <div
        class=""
        v-if="message.document !== null && message.message === null"
      >
        <img :src="'../../document/' + message.document" />
      </div>
      <div
        class=""
        v-if="message.document !== null && message.message !== null"
      >
        <img :src="'../../document/' + message.document" />{{ message.message }}
      </div>
    </div>
    <div v-if="message.doc_type == 'videos'">
      <div
        class=""
        v-if="message.document !== null && message.message === null"
      >
        <video controls muted>
          <source
            :src="'../../document/' + message.document"
            type="video/mp4"
          />
          Your browser does not support HTML video.
        </video>
      </div>
      <div
        class=""
        v-if="message.document !== null && message.message !== null"
      >
        <video controls muted>
          <source
            :src="'../../document/' + message.document"
            type="video/mp4"
          />
          Your browser does not support HTML video.</video
        >{{ message.message }}
      </div>
    </div>
  </div>
  <div
    v-else
    class="
      bg-indigo-400
      w-max
      my-2
      p-2
      rounded-xl rounded-tl-none
      clearfix
      text-white
    "
    style="max-width: 75%; max-width: 75%; max-width: 75%"
  >
    <div class="flex justify-between items-center mb-2 mt-1">
      <img
        class="mr-4 rounded-full w-8 h-8"
        :src="message.user.profile_photo_url"
        :alt="message.user.name"
      />
      <div class="ml-4">{{ message.user.name }}</div>
    </div>
    <div class="" v-if="message.document === null && message.message !== null">
      {{ message.message }}
    </div>
    <div v-if="message.doc_type == 'images'">
      <div
        class=""
        v-if="message.document !== null && message.message === null"
      >
        <img :src="'../../document/' + message.document" />
      </div>
      <div
        class=""
        v-if="message.document !== null && message.message !== null"
      >
        <img :src="'../../document/' + message.document" />{{ message.message }}
      </div>
    </div>
    <div v-if="message.doc_type == 'videos'">
      <div
        class=""
        v-if="message.document !== null && message.message === null"
      >
        <video controls muted>
          <source
            :src="'../../document/' + message.document"
            type="video/mp4"
          />
          Your browser does not support HTML video.
        </video>
      </div>
      <div
        class=""
        v-if="message.document !== null && message.message !== null"
      >
        <video controls muted>
          <source
            :src="'../../document/' + message.document"
            type="video/mp4"
          />
          Your browser does not support HTML video.</video
        >{{ message.message }}
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["message"],
  created() {
     
  },
};
</script>