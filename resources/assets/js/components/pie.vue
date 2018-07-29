<template>
    <div>
        <p class="copyright">{{anio}} &copy; Turnos PUCE By
            <a target="_blank" href="https://www.puce.edu.ec/">PUCE</a>
        </p>
        <a href="javascript:;" class="go2top">
            <i class="icon-arrow-up"></i>
        </a>
    </div>
</template>

<script>
    export default {
        name: "pie",
        computed:{
            anio:function(){
                return moment().format('YYYY');
            }
        }
    }
</script>

<style scoped>

</style>