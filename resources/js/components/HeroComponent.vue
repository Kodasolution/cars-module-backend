<template>
<div class="mx-auto" style="max-width:700px ;">
   <h2 class="py-3 left">Categories</h2>
    <div class="row row-cols-1 row-cols-md-3">
  
  <div class="col mb-4  mx-auto card-max-w">
    <div class="card h-60 ">
      <!--Card image-->
      <div class="view overlay">
        <img class="card-img-top " src="https://mdbootstrap.com/img/Photos/Others/images/16.webp" alt="Card image cap">
        <a href="#!">
          <div class="mask rgba-white-slight"></div>
        </a>
      </div>

      <!--Card content-->
      <div class="card-body">

        <!--Title-->
        <h4 class="card-title">Card title</h4>
        <!--Text-->
        <p class="card-text">Some quick example  .</p>
        <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
        <button type="button" class="btn btn-light-blue btn-md">Read more</button>

      </div>

    </div>
    <!-- Card -->
  </div>
  <div class="col mb-4  mx-auto card-max-w">
    <div class="card h-60">
      <!--Card image-->
      <div class="view overlay">
        <img class="card-img-top" src="https://mdbootstrap.com/img/Photos/Others/images/16.webp" alt="Card image cap">
        <a href="#!">
          <div class="mask rgba-white-slight"></div>
        </a>
      </div>

      <!--Card content-->
      <div class="card-body">

        <!--Title-->
        <h4 class="card-title">Card title</h4>
        <!--Text-->
        <p class="card-text">Some quick .</p>
        <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
        <button type="button" class="btn btn-light-blue btn-md">Read more</button>

      </div>

    </div>
    <!-- Card -->
  </div>
  <div class="col mb-4 mx-auto card-max-w">
    <div class="card h-60">
      <!--Card image-->
      <div class="view overlay">
        <img class="card-img-top" src="https://mdbootstrap.com/img/Photos/Others/images/16.webp" alt="Card image cap">
        <a href="#!">
          <div class="mask rgba-white-slight"></div>
        </a>
      </div>

      <!--Card content-->
      <div class="card-body">

        <!--Title-->
        <h4 class="card-title">Card title</h4>
        <!--Text-->
        <p class="card-text">Some </p>
        <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
        <button type="button" class="btn btn-light-blue btn-md">Read more</button>

      </div>

    </div>
    <!-- Card -->
  </div>
</div>
</div>
</template>
<script>
  export default {
        mounted() {
            console.log('Component hero mounted.')
        }
    }
</script>
<style>
.card-max-w{
    max-width: 220px;
}
</style>