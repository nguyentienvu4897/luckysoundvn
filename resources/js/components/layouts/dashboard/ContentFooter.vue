<template>
  <footer class="footer">
    <div class="container-fluid d-flex flex-wrap justify-content-between">
     <ul></ul>
      <div>
        <div class="copyright">
          © {{ year }}, made by<a
            href="javascript:;"
            class="font-weight-bold ml-1"
            target="_blank"
            rel="noopener"
            >Luckysound.vn</a
          >
        </div>
      </div>
    </div>
  </footer>
</template>
<script>
export default {
  data() {
    return {
      year: new Date().getFullYear(),
    };
  },
};
</script>
<style></style>
