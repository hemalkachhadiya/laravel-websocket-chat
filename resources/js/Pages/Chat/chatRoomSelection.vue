<template>
  <div class="">
    
    <div class="">
      <select
        v-model="selected"
        @change="$emit('roomchanged', selected)"
        class="float-right border-2 border-indigo-500 rounded-xl"
      >
        <option v-for="(room, index) in rooms" :key="index" :value="room">
          {{ room.name }}
        </option>
      </select>
      <div
        class="
          float-right
          bg-indigo-50
          rounded-md
          p-2
          mx-1
          cursor-pointer
          md:hidden
        "
        @click="$emit('createnewroom')"
      >
         <svg
          xmlns="http://www.w3.org/2000/svg"
          class="h-6 w-6"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
           v-if="newroom == false"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"
          />
        </svg>
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="h-6 w-6"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
          v-if="newroom == true"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M6 18L18 6M6 6l12 12"
          />
        </svg>
      </div>
    </div>
  </div>
</template> 
<script>
export default {
  props: ["rooms", "currentRoom", "newroom"],
  data: function () {
    return {
      selected: "",
    };
  },
  created() {
    this.selected = this.currentRoom;
  },
};
</script>