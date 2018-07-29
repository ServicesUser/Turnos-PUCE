<template>
    <div class="btn-group-notification btn-group" >
        <button type="button" class="btn btn-sm md-skip dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
            <i class="icon-bell"></i>
            <span class="badge">12</span>
        </button>
        <ul class="dropdown-menu-v2">
            <li class="external">
                <h3><span class="bold">12</span> notificaciones</h3>
                <a href="#">ver todas</a>
            </li>
            <li>
                <ul class="dropdown-menu-list scroller" style="height: 250px; padding: 0;" data-handle-color="#637283">
                    <li>
                        <a href="javascript:;">
                            <span class="details">
                                <span class="label label-sm label-icon label-success md-skip">
                                    <i class="fa fa-plus"></i>
                                </span> New user registered. </span>
                            <span class="time">just now</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        name: "notificaciones"
    }
</script>

<style scoped>

</style>