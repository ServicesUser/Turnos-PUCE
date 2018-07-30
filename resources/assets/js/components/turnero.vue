<template>
    
</template>

<script>
    export default {
        name: "turnero",
        mounted(){
            Echo.private('Turnos')
                .notification((e) => {
                    console.log(e);
                });
        }
    }
</script>

<style scoped>

</style>