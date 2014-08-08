<?php 
// <schema
//   attributeFormDefault = (qualified | unqualified) : unqualified
//   blockDefault = (#all | List of (extension | restriction | substitution))  : ''
//   elementFormDefault = (qualified | unqualified) : unqualified
//   finalDefault = (#all | List of (extension | restriction | list | union))  : ''
//   id = ID
//   targetNamespace = anyURI
//   version = token
//   xml:lang = language
//   {any attributes with non-schema namespace . . .}>
//   Content: ((include | import | redefine | annotation)*, (((simpleType | complexType | group | attributeGroup) | element | attribute | notation), annotation*)*)
// </schema>

?>
<schema
  attributeFormDefault = (qualified | unqualified) : unqualified
  blockDefault = (#all | List of (extension | restriction | substitution))  : ''
  elementFormDefault = (qualified | unqualified) : unqualified
  finalDefault = (#all | List of (extension | restriction | list | union))  : ''
  id = ID
  targetNamespace = anyURI
  version = token
  xml:lang = language
  {any attributes with non-schema namespace . . .}>
  Content: ((include | import | redefine | annotation)*, (((simpleType | complexType | group | attributeGroup) | element | attribute | notation))*)
</schema>