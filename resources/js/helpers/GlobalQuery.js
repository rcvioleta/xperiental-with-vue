class GlobalQuery {
    static fetchAll(url, callback) {
        axios
            .get(url)
            .then(response => callback(null, response.data))
            .catch(err => callback(err, null));
    }
}

export default GlobalQuery
