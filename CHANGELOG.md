# Changelog

All Notable changes to `darktec\util` will be documented in this file

### Added
- Collection <object,object>
    - Added ArrayAccess, Countable, IteratorAggregate and JsonSeriazable interfaces and necessary methods
    - Changed index from int to object
    - Various new methods
        - all (returns all items in collection)
        - count (countable implementation, returns count of items in collection)
        - search (searches collection for an item and returns the key)
        - toArray (returns collection object as a flat array, recursively applying itself)
        - toJson (returns collection object as flat json, recursively applying itself)

### Deprecated
- Collection length method - count method should now be used

### Fixed
- Nothing

### Removed
- Map <string,object> pair

### Security
- Nothing