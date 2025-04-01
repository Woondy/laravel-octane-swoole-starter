<?php

namespace App\Enums\Account;

/**
 * Enum representing different account statuses.
 */
enum AccountStatus: string
{
    /**
     * Fully operational account
     * - All transactions permitted
     * - Normal account functionality
     * - Visible to the account holder
     */
    case ACTIVE = 'active';

    /**
     * Temporarily restricted account
     * - No withdrawals/transfers allowed
     * - Deposits may still be accepted
     * - Typically initiated by:
     *   - Suspicious activity
     *   - Legal requirements
     *   - Security concerns
     */
    case FROZEN = 'frozen';

    /**
     * Terminated account
     * - No transactions permitted
     * - Balance must be zero
     * - Historical records preserved
     * - Cannot be reactivated
     */
    case CLOSED = 'closed';

    /**
     * Account awaiting activation
     * - Limited functionality
     * - May require:
     *   - Identity verification
     *   - Initial deposit
     *   - Manual approval
     */
    case PENDING = 'pending';

    /**
     * Restricted access account
     * - Only deposits allowed
     * - Withdrawals require approval
     * - Often used for:
     *   - Disputed accounts
     *   - Minors' accounts
     *   - Probate situations
     */
    case RESTRICTED = 'restricted';

    /**
     * Dormant/inactive account
     * - No transactions for extended period
     * - May incur inactivity fees
     * - Requires reactivation procedure
     */
    case DORMANT = 'dormant';

    /**
     * Account under investigation
     * - All transactions blocked
     * - Special audit logging
     * - Compliance/legal hold
     */
    case UNDER_REVIEW = 'under_review';

    /**
     * Scheduled for closure
     * - New transactions blocked
     * - Balance withdrawal period
     * - Final statements generated
     */
    case CLOSURE_IN_PROGRESS = 'closure_in_progress';

    /**
     * Gets all possible values for database storage and validation.
     * 
     * @return array<string> Array of all enum values
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}