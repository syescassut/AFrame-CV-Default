var getAbsolutePosition = function (element) {
    var getPos = function (el) {
        if (el.getAttribute("id") === "a-scene") {
            return {x: 0, y: 0, z: 0};
        }
        var pos = el.getAttribute("position");
        var posP = getPos(el.parentNode);

        return {x: pos.x + posP.x, y: pos.y + posP.y, z: pos.z + posP.z};
    };
    return getPos(element);
};

/**
 * Spawn sphere with impulse when event
 * 
 * Schema : 
 * 
 * Name                 | Type      | Description                               | Default
 * ================================================================================================
 * power                | number    | Power of impulse                          | 50
 * distance             | number    | Distance of start spheres with controller | 1
 * event                | string    | Event when spanw sphere                   | keydown
 * key                  | string    | Key for spawn sphere (if event = keydown) | n
 * idScene              | string    | id of a-scene                             | a-scene
 * 
 */
AFRAME.registerComponent('spawn-sphere', {
    schema: {
        power: {type: 'number', default: 50},
        distance: {type: 'number', default: 1},
        event: {type: 'string', default: 'keydown'},
        key: {type: 'string', default: 'n'},
        idScene: {type: 'string', default: 'a-scene'}
    },

    init: function () {
        var el = this.el;
        var scene = document.getElementById(this.data.idScene);
        var power = this.data.power * -1;
        var distanceStart = this.data.distance;
        var key = this.data.key;
        var canSpawn = true;
        var dataevent = this.data.event;
        
        if (scene == null) {
            console.error("ERROR [spawn-sphere] : scene is null");
            return;
        }
        
        spawnSphere = function (event) {
            if (dataevent !== "keydown" || event.key === key) {
                if (canSpawn === true) {
                    canSpawn = false;
                    setTimeout(function () {
                        canSpawn = true;
                    }, 50);

                    var sphere = document.createElement("a-sphere");
                    var pos = getAbsolutePosition(el);
                    var rot = el.getAttribute("rotation");

                    sphere.setAttribute("position", {
                        x: pos.x - Math.sin(rot.y / 180 * Math.PI) * Math.cos(rot.x / 180 * Math.PI) * distanceStart,
                        y: pos.y + Math.sin(rot.x / 180 * Math.PI) * distanceStart,
                        z: pos.z - Math.cos(rot.y / 180 * Math.PI) * Math.cos(rot.x / 180 * Math.PI) * distanceStart
                    });

                    sphere.setAttribute("radius", "0.2");
                    sphere.setAttribute("dynamic-body", "");
                    scene.appendChild(sphere);

                    var impulse = {
                        x: power * Math.sin(rot.y / 180 * Math.PI) * Math.cos(rot.x / 180 * Math.PI),
                        y: -power * Math.sin(rot.x / 180 * Math.PI),
                        z: power * Math.cos(rot.y / 180 * Math.PI) * Math.cos(rot.x / 180 * Math.PI)
                    };

                    sphere.addEventListener("body-loaded", function () {
                        setTimeout(function(){
                            sphere.body.applyImpulse(new CANNON.Vec3(impulse.x, impulse.y, impulse.z), new CANNON.Vec3().copy({x:0, y:0, z:0}));
                        }, 1);
                    });

                    setTimeout(function () {
                        sphere.setAttribute('opacity', "0.5");
                    }, 4000);

                    setTimeout(function () {
                        scene.removeChild(sphere);
                    }, 5000);
                }
            }
        };
        if(dataevent === "keydown"){
            document.addEventListener(dataevent, spawnSphere);
        }
        else {
            el.addEventListener(dataevent, spawnSphere);
        }
            
    }
});