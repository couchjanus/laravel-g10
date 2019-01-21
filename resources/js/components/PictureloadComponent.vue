<template>
  <div class="container-fluid">
    <div class="card border-success text-center mb-3">
      <div class="card-header bg-transparent border-success">Picture Upload Component</div>
      <div class="card-body text-success">
        <h5 class="card-title">
          <label for="title">Add New Picture:</label>
          <input v-model="name" class="form-control" type="text">
        </h5>
        <div class="row">
          <div class="col-3" v-if="image">
            <img :src="image" class="img-responsive" height="70" width="90">
          </div>
          <div class="col-md-5">
            <input type="file" v-on:change="onImageChange">
          </div>
          <div class="col-md-4">
            <button class="btn btn-success btn-block" @click="uploadImage">Upload Image</button>
          </div>
        </div>
      </div>
      <div class="card-footer bg-transparent border-success">Footer</div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      image: "",
      name
    };
  },
  methods: {
    onImageChange(e) {
      let files = e.target.files || e.dataTransfer.files;
      if (!files.length) return;
      this.createImage(files[0]);
    },
    createImage(file) {
      let reader = new FileReader();
      let vm = this;
      reader.onload = e => {
        vm.image = e.target.result;
      };
      reader.readAsDataURL(file);
    },
    uploadImage() {
      axios
        .post("/pictures", { image: this.image, name: this.name })
        .then(response => {
          window.location.reload();
          console.log(response);
        })
        .catch(function(error) {
          console.log(error);
        });
    }
  }
};
</script>