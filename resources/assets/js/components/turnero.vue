<template>
    
</template>

<script>
    export default {
        name: "turnero",
        mounted(){
            Echo.private('Turnos')
                .notification('ActualizarTurnero',(e) => {
                    console.log(e);
                });
        }
    }
</script>

<style scoped>

</style>