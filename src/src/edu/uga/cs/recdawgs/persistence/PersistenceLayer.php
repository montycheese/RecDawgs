<?php

/**
 * This is the interface to the Persistence Layer subsystem of the RecDawgs system.  This layer
 * provides operations for storing, restoring, and deleting of entity class objects and links
 * existing among them.
 * <p>
 * Each entity class <code><i>Class</i></code> has three types of operations:
 * <ul>
 *  <li><code>restore<i>Class</i></code>, which restores entity objects satisfying a search criteria specified by a
 *        <code>model<i>Class</i></code> entity,
 *  <li><code>store<i>Class</i></code>, which stores a new, or updates an existing entity object, and
 *  <li><code>delete<i>Class</i></code>, which removes an existing entity object from the persistent data store.
 * </ul>
 * <p>
 * Each association between two entity classes <code><i>ClassA</i></code> and <code><i>ClassB</i></code> has
 * three types of operations:
 * <ul>
 * <li><code>store<i>ClassAClassB</i></code>, which is used to store a link between two instances of <code><i>ClassA</i></code>
 *     and <code><i>ClassB</i></code> in the persistent data store,</li>
 * <li><code>restore<i>ClassAClassB</i></code>, two overloaded versions are used to restore the link from
 *     <code><i>ClassA</i></code> to <code><i>ClassB</i></code> and from
 *     <code><i>ClassB</i></code> to <code><i>ClassA</i></code>, and</li>
 * <li><code>delete<i>ClassAClassB</i></code>, which is used to remove the link connecting two object instances
 *      from the persistent data store.</li>
 * </ul>
 * <p>
 * In case there are two associations connecting the same two entity classes, the names of the association-related operations include
 * the name of the association between the classes.  Furthermore, depending on the multiplicity of the association endpoint,
 * the return value is either <code><i>ClassA</i></code> (<code><i>ClassB</i></code>), if the multiplicity is <i>one</i>
 * or <i>optional</i>, or an <code>Iterator&lt;<i>ClassA</i>&gt;</code> (<code>Iterator&lt;<i>ClassB</i>&gt;</code>), if
 * the multiplicity is <i>many</i>.
 */
public interface PersistanceLayer{

}