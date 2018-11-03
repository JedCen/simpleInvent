<template>
  <div class="filter-bar pull-right">
    <form class="form-inline">
      <div class="form-group">
        <i id="busc" class="icon ion-search">  </i> 
        <input type="text" v-model="search" placeholder="Buscar por nombre">  
      </div>
      <button type="button" class="btn btn-default" @click.prevent="resetSearch">Reset</button>
    </form> 
  </div>
</template>

<script>
  export default {
    data () {
      return {
        search: ''
      }
    },
    computed: {
      filteredPosts: function () {
                    return this.posts.filter((posts) => {
                        return posts.name.match(this.search);
                    });
                }
    },
    methods: {
      resetSearch () {
        this.search = ''
      }
    }
  }
</script>
<style>
.filter-bar {
  padding: 10px;
}
.filter-bar input{
    border-radius: 5px;
}
#busc {
    padding-right: 10px;
}
</style>