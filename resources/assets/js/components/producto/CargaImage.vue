<template>
<div>
    <div v-for="(item, index) in items" :key="index">
        <div v-if="!item.image">
        <h4>Selecciona una imagen</h4>
        <input class="btn btn-default btn-block" name="image" type="file" @change="onFileChange(item, $event)">
        </div>
        <div v-else>
        <img class="cargaimage" name="image" :src="item.image" />
        <button class="btn btn-danger" @click.prevent="removeImage(item)" name="image">Quitar image</button>
        <input class="btn btn-default" name="image" type="file" @change="onFileChange(item, $event)">
        </div>
    </div>
</div>
</template>
<script>
    export default {
        data() {
            return {
                items: [
                    {
                        image: false,
                    },
                ],
            }
        },
        methods: {
            onFileChange(item, e) {
            var files = e.target.files || e.dataTransfer.files;
            if (!files.length)
                return;
            this.createImage(item, files[0]);
            },
            createImage(item, file) {
            var image = new Image();
            var reader = new FileReader();
            reader.onload = (e) => {
                item.image = e.target.result;
            };
            reader.readAsDataURL(file);
            },
            removeImage: function (item) {
            item.image = false;
            }
        }
    }
  </script>
  <style>
  .cargaimage {
  width: 30%;
  margin: auto;
  display: block;
  margin-bottom: 10px;
}
  </style>
  

