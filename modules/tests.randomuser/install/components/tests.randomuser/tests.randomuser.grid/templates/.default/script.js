function gridUpdate() {

    var url=false;

    function setUrl (url) {
        this.url=url;
    }

    function setNat (id,select) {
        var selectedOption = select.options[select.selectedIndex];
        if( this.url)
        {
            var post = {};
            post['id'] = id;
            post['nat'] = selectedOption.value;
            BX.ajax.post(
                this.url,
                post
            );
        }
    }

    this.setUrl=setUrl;
    this.setNat=setNat;
}