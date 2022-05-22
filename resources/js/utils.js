String.prototype.slugify = function (separator = "-") {
    return this
        .toString()
        .normalize('NFD')                   // split an accented letter in the base letter and the acent
        .replace(/[\u0300-\u036f]/g, '')   // remove all previously split accents
        .toLowerCase()
        .trim()
        .replace(/[^a-z0-9\- ]/g, '')   // remove all chars not letters, numbers and spaces (to be replaced)
        .replace(/\s+/g, separator);
};

window.lc = {
    key: 'fr.mmibdx.invitations.scanner',
    setItem: function(item, value) {
        localStorage.setItem(`${this.key}.${item}`, value)
    },
    getItem: function(item) {
        return localStorage.getItem(`${this.key}.${item}`)
    }
}