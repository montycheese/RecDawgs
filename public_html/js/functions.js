/**
 * Created by montanawong on 2/15/16.
 */

function toggle(id){
    var e = document.getElementById(id);
    if (e.style.display == 'block' || e.style.display=='') {
        e.style.display = 'none';
    }
    else {
        e.style.display = 'block';
    }
}