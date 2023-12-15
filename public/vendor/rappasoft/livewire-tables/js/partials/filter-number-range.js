/*jshint esversion: 6 */
export function nrf() {
    Alpine.data('numberRangeFilter', (wire, filterKey, parentElementPath, filterConfig, childElementRoot) => ({
    allFilters: wire.entangle('filterComponents', false),
    originalMin: 0,
    originalMax: 100,
    filterMin: 0,
    filterMax: 100,
    currentMin: 0,
    currentMax: 100,
    hasUpdate: false,
    wireValues: wire.entangle('filterComponents.' + filterKey, false),
    defaultMin: filterConfig['minRange'],
    defaultMax: filterConfig['maxRange'],
    restrictUpdates: false,
    updateStyles() {
        let numRangeFilterContainer = document.getElementById(parentElementPath);
        let currentFilterMin = document.getElementById(childElementRoot + "-min");
        let currentFilterMax = document.getElementById(childElementRoot + "-max");
        numRangeFilterContainer.style.setProperty('--value-a', currentFilterMin.value);
        numRangeFilterContainer.style.setProperty('--text-value-a', JSON.stringify(currentFilterMin.value));
        numRangeFilterContainer.style.setProperty('--value-b', currentFilterMax.value);
        numRangeFilterContainer.style.setProperty('--text-value-b', JSON.stringify(currentFilterMax.value));
    },
    setupWire() {
        if (this.wireValues !== undefined) {
            this.filterMin = this.originalMin = (this.wireValues['min'] !== undefined) ? this.wireValues['min'] : this.defaultMin;
            this.filterMax = this.originalMax = (this.wireValues['max'] !== undefined) ? this.wireValues['max'] : this.defaultMax;
        } else {
            this.filterMin = this.originalMin = this.defaultMin;
            this.filterMax = this.originalMax = this.defaultMax;
        }
        this.updateStyles();
    },
    allowUpdates() {
        this.updateWire();
    },
    updateWire() {
        let tmpFilterMin = parseInt(this.filterMin);
        let tmpFilterMax = parseInt(this.filterMax);

        if (tmpFilterMin != this.originalMin || tmpFilterMax != this.originalMax) {
            if (tmpFilterMax < tmpFilterMin) {
                this.filterMin = tmpFilterMax;
                this.filterMax = tmpFilterMin;
            }
            this.hasUpdate = true;
            this.originalMin = tmpFilterMin;
            this.originalMax = tmpFilterMax;
        }
        this.updateStyles();
    },
    updateWireable() {
        if (this.hasUpdate) {
            this.hasUpdate = false;
            this.wireValues = { 'min': this.filterMin, 'max': this.filterMax };
            wire.set('filterComponents.' + filterKey, this.wireValues);
        }

    },
    init() {
        this.setupWire();
        this.$watch('allFilters', value => this.setupWire());
    },
}));
}

export default nrf;
