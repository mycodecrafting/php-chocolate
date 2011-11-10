<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */



/**
 * Versioning that is based on the NumVersion Struct
 *
 * Has the following revision indicators:
 *
 *     [major revision].[minor revision].[bug revision]-[stage][stage revision]
 *
 * Major revision increments indicate significant changes and/or jumps in functionality and/or programming
 *
 *     The major revision number begins at 1 and increments from there.
 *
 *     The major revision number may not jump or skip any revisions.
 *
 * Minor revision increments indicate minor feature changes and/or significant bug fixes.
 *
 *     The minor revision number is limited to a single digit, 0 - 9.
 *
 *     The minor revision number may jump or skip revisions if there are significant changes,
 *     but not significant enough to warrant a major revision increment. As a general guide,
 *     the jumping should be done in increments of 5 revisions, thus allowing only one jump per
 *     major revision before the major revision must be incremented. Minor revision releases may
 *     be referred to as "point releases".
 *
 * Bug revision increments indicate minor bug fixes.
 *
 *     The bug revision number is limited to a single digit, 0 - 9.
 *
 *     The bug revision number may not jump or skip any revisions. If there are significant enough
 *     fixes to warrant such a revision jump, the minor revision should be incremented instead.
 *
 * Stage indicator:
 *
 *     Consists of a string belonging to one of "dev", "alpha", "beta", "rc", or "final", where:
 *
 *         "dev" stages are internal private releases
 *         "alpha" stages are very early releases that may or may not be plublic releases
 *         "beta" stages are public releases intended for early adopters and other "beta testers"
 *         "rc" stages are release candidates indended for more widespread testing
 *         "final" stages are stable releases and should be "production worthy"
 *
 * Stage revision:
 *
 *     The stage revision number begins at 1 and increments from there.
 *
 *     The stage revision number may not jump or skip any revisions.
 *
 * In the case of final stage releases, the stage and stage revision indicators are omitted.
 *
 * Only the final release stage may increment the other revisions.
 *
 * When a revision indicator's number increments, all lower revision indicators should roll back
 * to their starting position.
 */
final class php_chocolate_version
{

    const APP_NAME  = 'Chocolate (BDD for PHP)';
    const MAJOR_REV = 1;
    const MINOR_REV = 0;
    const BUG_REV   = 0;
    const STAGE     = 'dev';
    const STAGE_REV = 14;
    const REL_DATE  = '2011-11-09';

    public static function get_version()
    {
        if (self::STAGE === 'final')
        {
            return self::APP_NAME . ' ' . self::MAJOR_REV . '.' . self::MINOR_REV . '.' .
                self::BUG_REV;
        }

        return self::APP_NAME . ' ' . self::MAJOR_REV . '.' . self::MINOR_REV . '.' .
            self::BUG_REV . '-' . self::STAGE . self::STAGE_REV;
    }

    public static function get_version_with_date()
    {
        return self::get_version() . ' (' . self::REL_DATE . ')';
    }

}
