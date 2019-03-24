export function parseVar(value: any, type: string): any {
  switch (type) {
    case 'str':
    case 'string':
    case 'char':
      return '' + value;
    case 'int':
      return parseInt(value);
    case 'double':
    case 'float':
      return parseFloat(value);
    case 'boolean':
    case 'bool':
      return !!value;
    default:
      return value;
  }
}
