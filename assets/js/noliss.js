function MoveCheck() {
    if( confirm("投稿を削除しますか？") ) {
    	return true;
    }
    else {
        alert("やめました");
        return false;
    }
}