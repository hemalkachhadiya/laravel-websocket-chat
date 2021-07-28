<template>
  <div class="flex items-center my-2 mx-2">
    <div class="h-12 w-12 bg-indigo-100 rounded-full"></div>
    <div class="ml-2">
      <!-- <div class="font-bold text-lg">{{ roomowner.name }}</div> -->
      <!-- <div v-if="roomowner.type == 'group'">{{ roomowner.usernames }}</div> -->
      <!-- <div v-if="roomowner.type == 'private'">Online</div> -->
    </div>
  </div>
</template>
<script>
export default {
  props: ["currentRoom"],
  data: function () {
    return {
      selected: "",
      roomowner: null,
    };
  },
  methods:{
    roomdetails(id){
       axios
        .post("/roomdetails", {
          room_id: id,
        })
        .then((result) => {
          this.roomowner = result.data;
        })
        .catch((err) => {
          console.log(err);
        });
    }
  },
  created() {
    this.selected = this.currentRoom;
    if(this.selected.name == null){
     this.roomdetails(this.selected.id);
    }
  },
};
</script>